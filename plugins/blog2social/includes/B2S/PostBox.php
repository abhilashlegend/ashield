<?php

class B2S_PostBox {

    private $b2sSiteUrl;
    private $postLang;
    private $userOption;

    public function __construct() {
        $this->b2sSiteUrl = get_option('siteurl') . ((substr(get_option('siteurl'), -1, 1) == '/') ? '' : '/');
        $this->postLang = strtolower(substr(get_locale(), 0, 2));
        $this->userOption = new B2S_Options(B2S_PLUGIN_BLOG_USER_ID);
    }

    public function getPostBox($postId = 0, $postType = 'post', $postStatus = '') {

        $isChecked = "";
        $lastPost = "";

        $autoPostOption = $this->userOption->_getOption('auto_post');
        $optionUserTimeZone = $this->userOption->_getOption('user_time_zone');
        $userTimeZone = ($optionUserTimeZone !== false) ? $optionUserTimeZone : get_option('timezone_string');
        $userTimeZoneOffset = (empty($userTimeZone)) ? get_option('gmt_offset') : B2S_Util::getOffsetToUtcByTimeZone($userTimeZone);
        $selectedProfileID = get_option('B2S_PLUGIN_SAVE_META_BOX_AUTO_SHARE_PROFILE_USER_' . B2S_PLUGIN_BLOG_USER_ID);
        $b2sHeartbeatFaqLink = '<a target="_blank" href="' . esc_url(B2S_Tools::getSupportLink('system')) . '">' . esc_html__('Please see FAQ', 'blog2social') . '</a>';
        $metaSettings = get_option('B2S_PLUGIN_GENERAL_OPTIONS');
        $autoPostImport = false;

        if (B2S_PLUGIN_USER_VERSION > 0) {
            if ($postId > 0) {
                global $wpdb;
                $lastAutopost = $wpdb->get_results($wpdb->prepare("SELECT publish_date FROM {$wpdb->prefix}b2s_posts WHERE post_id= %d AND blog_user_id= %d AND sched_type = 3 ORDER BY publish_date DESC LIMIT 1", $postId, B2S_PLUGIN_BLOG_USER_ID));
                if (!empty($lastAutopost) && isset($lastAutopost[0]) && !empty($lastAutopost[0]->publish_date) && $lastAutopost[0]->publish_date != '0000-00-00 00:00:00') {
                    $lastPost = '<b>' . esc_html__('last auto-post:', 'blog2social') . '</b> ' . esc_html(B2S_Util::getCustomDateFormat($lastAutopost[0]->publish_date, substr(B2S_LANGUAGE, 0, 2))) . '<br>';
                }
            }

            if ($autoPostOption !== false) {
                $state = ($postId == 0) ? 'publish' : (($postStatus != '' && ($postStatus == 'publish' || $postStatus == 'future')) ? 'update' : '');
                if (is_array($autoPostOption) && isset($autoPostOption[$state])) {
                    if (in_array($postType, $autoPostOption[$state])) {
                        $isChecked = 'checked';
                    }
                }
            }
            //Auto-Post-Import - Check Conditions - show notice
            $autoPostData = $this->userOption->_getOption('auto_post_import');
            if ($autoPostData !== false && is_array($autoPostData)) {
                if (isset($autoPostData['active']) && (int) $autoPostData['active'] == 1) {
                    $autoPostImport = true;
                    if (isset($autoPostData['post_filter']) && (int) $autoPostData['post_filter'] == 1) {
                        if (isset($autoPostData['post_type']) && is_array($autoPostData['post_type']) && !empty($autoPostData['post_type'])) {
                            if (isset($autoPostData['post_type_state']) && (int) $autoPostData['post_type_state'] == 0) { //include
                                if (!in_array($postType, $autoPostData['post_type'])) {
                                    $autoPostImport = false;
                                }
                            } else { //exclude
                                if (in_array($postType, $autoPostData['post_type'])) {
                                    $autoPostImport = false;
                                }
                            }
                        }
                    }
                    $autoPostCon = $this->userOption->_getOption('auto_post_import_condition');
                    if ($autoPostCon !== false && is_array($autoPostCon) && isset($autoPostCon['count'])) {
                        $con = unserialize(B2S_PLUGIN_AUTO_POST_LIMIT);
                        if ($autoPostCon['count'] == $con[B2S_PLUGIN_USER_VERSION]) {
                            $autoPostImport = false;
                        }
                    }
                }
            }
        }

        $content = '<div class="b2s-post-meta-box">
                      <div id="b2s-server-connection-fail" class="b2s-info-error"><button class="b2s-btn-close-meta-box b2s-close-icon" data-area-id="b2s-server-connection-fail" title="close notice"></button>' . esc_html__('The connection to the server failed. Try again!', 'blog2social') . '</div>
                      <div id="b2s-heartbeat-fail" class="b2s-info-error"><button class="b2s-btn-close-meta-box b2s-close-icon" data-area-id="b2s-heartbeat-fail" title="close notice"></button>' . esc_html__('WordPress uses heartbeats by default, Blog2Social as well. Please enable heartbeats for using Blog2Social!', 'blog2social') . $b2sHeartbeatFaqLink . ' </div>
                      <div id="b2s-post-meta-box-state-no-publish-future-customize" class="b2s-info-error"><button class="b2s-btn-close-meta-box b2s-close-icon" data-area-id="b2s-post-meta-box-state-no-publish-future-customize" title="close notice"></button>' . esc_html__('Your post is still on draft or pending status. Please make sure that your post is published or scheduled to be published on this blog. You can then auto-post or schedule and customize your social media posts with Blog2Social.', 'blog2social') . '</div>
                      <div id="b2s-post-meta-box-state-no-auth" class="b2s-info-error"><button class="b2s-btn-close-meta-box b2s-close-icon" data-area-id="b2s-post-meta-box-state-no-auth" title="close notice"></button>' . esc_html__('There are no social network accounts assigned to your selected network collection. Please assign at least one social network account or select another network collection.', 'blog2social') . '<a href="' . esc_url($this->b2sSiteUrl . 'wp-admin/admin.php?page=blog2social-network') . '" target="_bank">' . esc_html__('Network settings', 'blog2social') . '</a></div>
                      <div id="b2s-post-meta-box-state-no-publish-future" class="b2s-info-error"><button class="b2s-btn-close-meta-box b2s-close-icon" data-area-id="b2s-post-meta-box-state-no-publish-future" title="close notice"></button>' . esc_html__('Your post is still on draft or pending status. Please make sure that your post is published or scheduled to be published on this blog. You can then auto-post or schedule and customize your social media posts with Blog2Social.', 'blog2social') . '</div>
                      <div id="b2s-url-valid-warning" class="b2s-info-warning"><button class="b2s-btn-close-meta-box b2s-close-icon" data-area-id="b2s-url-valid-warning" title="close notice"></button>' . esc_html__('Notice: Please make sure, that your website address is reachable. The Social Networks do not allow postings from local installations.', 'blog2social') . '</div>
                      <input type="hidden" id="b2s-redirect-url-customize" name="b2s-redirect-url-customize" value="' . esc_attr($this->b2sSiteUrl . 'wp-admin/admin.php?page=blog2social-ship&postId=') . '"/>
                      <input type="hidden" id="b2s-user-last-selected-profile-id" name="b2s-user-last-selected-profile-id" value="' . esc_attr(($selectedProfileID !== false ? (int) $selectedProfileID : 0)) . '" />
                      <input type="hidden" id="b2s-home-url" name="b2s-home-url" value="' . esc_attr(get_option('home')) . '"/>
                      <input type="hidden" id="b2sLang" name="b2s-user-lang" value="' . esc_attr(strtolower(substr(get_locale(), 0, 2))) . '">
                      <input type="hidden" id="b2sUserLang" name="b2s-user-lang" value="' . esc_attr(strtolower(substr(get_locale(), 0, 2))) . '">
                      <input type="hidden" id="b2sPostLang" name="b2s-post-lang" value="' . esc_attr(substr($this->postLang, 0, 2)) . '">
                      <input type="hidden" id="b2sPluginUrl" name="b2s-post-lang" value="' . esc_attr(B2S_PLUGIN_URL) . '">    
                      <input type="hidden" id="b2sBlogUserId" name="b2s-blog-user-id" value="' . esc_attr(B2S_PLUGIN_BLOG_USER_ID) . '">              
                      <input type="hidden" id="b2s-user-timezone" name="b2s-user-timezone" value="' . esc_attr($userTimeZoneOffset) . '"/>
                      <input type="hidden" id="b2s-post-status" name="b2s-post-status" value="' . esc_attr(trim(strtolower($postStatus))) . '"/>
                      <input type="hidden" name="b2s-post-meta-box-version" id="b2s-post-meta-box-version" value="' . esc_attr(B2S_PLUGIN_USER_VERSION) . '"/>
                      <input type="hidden" id="isOgMetaChecked" name="isOgMetaChecked" value="' . esc_attr((isset($metaSettings['og_active']) ? (int) $metaSettings['og_active'] : 0)) . '">
                      <input type="hidden" id="isCardMetaChecked" name="isCardMetaChecked" value="' . esc_attr((isset($metaSettings['card_active']) ? (int) $metaSettings['card_active'] : 0)) . '">
                      <input type="hidden" id="b2sAutoPostImportIsActive" name="autoPostImportIsActive" value="' . (($autoPostImport) ? 1 : 0) . '">
                      
                      <h3 class="b2s-meta-box-headline">' . esc_html__('Custom Sharing & Scheduling', 'blog2social') . ' <a class="b2s-info-btn" data-modal-target="b2sInfoMetaBoxModalSched" href="#">' . esc_html__('Info', 'blog2social') . '</a></h3>
                      <a id="b2s-meta-box-btn-customize" class="b2s-btn b2s-btn-success b2s-btn-sm b2s-center-block b2s-btn-margin-bottom-15" href="#">' . esc_html__('Customize & Schedule Social Media Posts', 'blog2social') . '</a>
                      <hr>
                      <div class="b2s-info-warning" style="display:block;"><b>' . esc_html__('Facebook Instant Sharing:', 'blog2social') . '</b><br>' . esc_html__('Auto-posts for Facebook Profiles will be shown in the "Instant Sharing" tab on your "Posts & Sharing" navigation bar and can be shared on your Facebook Profile by clicking on the "Share" button next to your auto-post.', 'blog2social') . '</div>
                      <h3 class="b2s-meta-box-headline">' . esc_html__('Social Media Auto-Posting', 'blog2social') . ' <a class="b2s-info-btn" data-modal-target="b2sInfoMetaBoxModalAutoPost" href="#">' . esc_html__('Info', 'blog2social') . '</a></h3>
                      ' . $lastPost;

        $content .='<input id="b2s-post-meta-box-time-dropdown-publish" class="post-format" ' . ((B2S_PLUGIN_USER_VERSION == 0) ? 'disabled' : '') . ' name="b2s-post-meta-box-time-dropdown" value="publish" type="checkbox" ' . $isChecked . '>
                      <label for="b2s-post-meta-box-time-dropdown-publish" class="post-format-icon">' . esc_html__('enable Auto-Posting', 'blog2social') . '</label>';

        if (B2S_PLUGIN_USER_VERSION == 0) {
            $content .= ' <span class="b2s-label b2s-label-success"><a href="#" class="b2s-btn-label-premium b2s-info-btn" data-modal-target="b2sInfoMetaBoxModalAutoPost">' . esc_html__("PREMIUM", "blog2social") . '</a></span>';
        }

        $content .='<div class="b2s-loading-area" style="display:none">
                        <br>
                        <div class="b2s-loader-impulse b2s-loader-impulse-md"></div>
                        <div class="clearfix"></div>
                        <small>' . esc_html__('Loading...', 'blog2social') . '</small>
                       </div>
                    </div>';

        $content .=' <div class="b2s-meta-box-modal" id="b2sInfoMetaBoxModalSched" aria-hidden="true" style="display:none;">
                        <div class="b2s-meta-box-modal-dialog">
                            <div class="b2s-meta-box-modal-header">
                                  <a href="#" class="b2s-meta-box-modal-btn-close" data-modal-target="b2sInfoMetaBoxModalSched" aria-hidden="true">??</a>
                              <h4 class="b2s-meta-box-modal-title">' . esc_html__('Blog2Social: Customize & Schedule Social Media Posts', 'blog2social') . '</h4>
                            </div>
                            <div class="b2s-meta-box-modal-body">
                              <p>' . esc_html__('Customize and schedule your social media posts on the one page preview for all your selected networks: tailor your posts with individual comments, #hashtags or @handles and schedule your posts for the best times to post, for multiple times or re-share recurrently for more visibility and engagement with your community.', 'blog2social') . '</p>
                            </div>
                        </div>
                    </div>';

        $content .= '<div class="b2s-meta-box-modal" id="b2sInfoMetaBoxModalAutoPost" aria-hidden="true" style="display:none;">
                        <div class="b2s-meta-box-modal-dialog">
                            <div class="b2s-meta-box-modal-header">
                                  <a href="#" class="b2s-meta-box-modal-btn-close" data-modal-target="b2sInfoMetaBoxModalAutoPost" aria-hidden="true">??</a>
                              <h4 class="b2s-meta-box-modal-title">' . esc_html__('Blog2Social: Social Media Auto-Posting', 'blog2social') . '</h4>
                            </div>
                            <div class="b2s-meta-box-modal-body">
                              <p>
                           ' . esc_html__('Share your blog posts with the Auto Poster: Your blog posts will be shared automatically on your social media channels as soon as you publish or update a new post. You can also choose to autopost scheduled blog posts as soon as they are published.', 'blog2social');
        $content .= ' ' . sprintf(__('<a target="_blank" href="%s">Learn how to set up auto posting for your blog posts</a>', 'blog2social'), esc_url(B2S_Tools::getSupportLink('auto_poster_m')));

        if (B2S_PLUGIN_USER_VERSION == 0) {
            $content .= '<hr>
                            <h4 class="b2s-meta-box-modal-h4">' . esc_html__('You want to auto-post your blog post?', 'blog2social') . '</h4>
                            ' . esc_html__('With Blog2Social Premium you can:', 'blog2social') . '
                                <br>
                                <br>
                                - ' . esc_html__('Post on pages and groups', 'blog2social') . '<br>
                                - ' . esc_html__('Share on multiple profiles, pages and groups', 'blog2social') . '<br>
                                - ' . esc_html__('Auto-post and auto-schedule new and updated blog posts', 'blog2social') . '<br>
                                - ' . esc_html__('Schedule your posts at the best times on each network', 'blog2social') . '<br>
                                - ' . esc_html__('Best Time Manager: use predefined best time scheduler to auto-schedule your social media posts', 'blog2social') . '<br>
                                - ' . esc_html__('Schedule your post for one time, multiple times or recurrently', 'blog2social') . '<br>
                                - ' . esc_html__('Schedule and re-share old posts', 'blog2social') . '<br>
                                - ' . esc_html__('Select link format or image format for your posts', 'blog2social') . '<br>
                                - ' . esc_html__('Select individual images per post', 'blog2social') . '<br>
                                - ' . esc_html__('Reporting & calendar: keep track of your published and scheduled social media posts', 'blog2social') . '<br>
                                <br>
                                <a target="_blank" href="' . esc_url(B2S_Tools::getSupportLink('affiliate')) . '" class="b2s-btn b2s-btn-success b2s-center-block b2s-btn-none-underline">' . esc_html__('Upgrade to PREMIUM', 'blog2social') . '</a>
                                <br>
                                <center>' . sprintf(__('or <a target="_blank" href="%s">start with free 30-days-trial of Blog2Social Premium</a> (no payment information needed)', 'blog2social'), esc_url('https://service.blog2social.com/trial')) . '</center>';
        }
        $content .= '</p>
                            </div>
                        </div>
                      </div>
                   ';

        return $content;
    }

    public function getPostBoxAutoHtml($mandant = array(), $auth = array()) {
        $authContent = '';
        $content = '<br><div class="b2s-meta-box-auto-post-area"><label for="b2s-post-meta-box-profil-dropdown">' . esc_html__('Select network collection:', 'blog2social') . ' <div style="float:right;"><a href="' . esc_url($this->b2sSiteUrl . 'wp-admin/admin.php?page=blog2social-network') . '" target="_blank">' . esc_html__('Network settings', 'blog2social') . '</a></div></label>
            <select style="width:100%;" id="b2s-post-meta-box-profil-dropdown" name="b2s-post-meta-box-profil-dropdown">';
        foreach ($mandant as $k => $m) {
            $content .= '<option value="' . esc_attr($m->id) . '">' . esc_html((($m->id == 0) ? __($m->name, 'blog2social') : $m->name)) . '</option>';
            $profilData = (isset($auth->{$m->id}) && isset($auth->{$m->id}[0]) && !empty($auth->{$m->id}[0])) ? json_encode($auth->{$m->id}) : '';
            $authContent .= "<input type='hidden' id='b2s-post-meta-box-profil-data-" . esc_attr($m->id) . "' name='b2s-post-meta-box-profil-data-" . esc_attr($m->id) . "' value='" . base64_encode($profilData) . "'/>";
        }
        $content .= '</select></div>';
        $content .= $authContent;

        //TOS Twitter 032018 - none multiple Accounts - User select once
        $content .='<div class="b2s-meta-box-auto-post-twitter-profile"><label for="b2s-post-meta-box-profil-dropdown-twitter">' . esc_html__('Select Twitter profile:', 'blog2social') . '</div></label> <select style="width:100%;" id="b2s-post-meta-box-profil-dropdown-twitter" name="b2s-post-meta-box-profil-dropdown-twitter">';
        foreach ($mandant as $k => $m) {
            if ((isset($auth->{$m->id}) && isset($auth->{$m->id}[0]) && !empty($auth->{$m->id}[0]))) {
                foreach ($auth->{$m->id} as $key => $value) {
                    if ($value->networkId == 2) {
                        $content .= '<option data-mandant-id="' . esc_attr($m->id) . '" value="' . esc_attr($value->networkAuthId) . '">' . esc_html($value->networkUserName) . '</option>';
                    }
                }
            }
        }
        $content .= '</select></div>';


        //new V5.1.0 Seeding
        $bestTimeType = 0;  //0=default(best time), 1= special per account (seeding), 2= per network (old)
        $myBestTimeSettings = $this->userOption->_getOption('auth_sched_time');
        if (isset($myBestTimeSettings['time'])) {
            $bestTimeType = 1;
            //old  
        } else {
            global $wpdb;
            if ($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}b2s_post_sched_settings'") == $wpdb->prefix . 'b2s_post_sched_settings') {
                $myBestTimeSettings = $wpdb->get_results($wpdb->prepare("SELECT network_id, network_type, sched_time FROM {$wpdb->prefix}b2s_post_sched_settings WHERE blog_user_id= %d", B2S_PLUGIN_BLOG_USER_ID));
                if (is_array($myBestTimeSettings) && !empty($myBestTimeSettings)) {
                    $bestTimeType = 2;
                } else {
                    //default
                    $myBestTimeSettings = B2S_Tools::getRandomBestTimeSettings();
                }
            }
        }
        $content .='<label>' . esc_html__('When do you want to share your post on social media?', 'blog2social') . '</label>';
        $content .= '<div class="b2s-post-meta-box-sched-area">';
        $content .='<select class="b2s-post-meta-box-sched-select" style="width:100%;" name="b2s-post-meta-box-sched-select">
                        <option value="0">' . esc_html__('immediately after publishing', 'blog2social') . '</option>
                        <option value="1">' . esc_html__('at scheduled times', 'blog2social') . '</option>
                        <option value="2">' . esc_html__('schedule (best times)', 'blog2social') . '</option>
                        </select>';

        $content .='<div id="b2s-post-meta-box-note-premium" class="b2s-info-success"><button class="b2s-btn-close-meta-box b2s-close-icon" data-area-id="b2s-post-meta-box-note-premium" title="close notice"></button><b>' . esc_html__('You want to schedule your blog post with Auto-Poster?', 'blog2social') . '</b><br> <a class="" target="_blank" href="' . esc_url(B2S_Tools::getSupportLink('affiliate')) . '">' . esc_html__('Upgrade to PREMIUM PRO', 'blog2social') . '</a></div>';

        $content .='<div class="b2s-post-meta-box-sched-once" style="display:none;">';
        //Opt: CustomDatePicker
        $dateFormat = (substr(B2S_LANGUAGE, 0, 2) == 'de') ? 'dd.mm.yyyy' : 'yyyy-mm-dd';
        $timeFormat = (substr(B2S_LANGUAGE, 0, 2) == 'de') ? 'hh:ii' : 'hh:ii aa';
        $content .='<label class="b2s-font-bold">' . esc_html__('Select date:', 'blog2social') . '</label>';
        $content .='<a href="#b2s-post-box-calendar-header" id="b2s-post-box-calendar-btn" class="pull-right">' . esc_html__('show calendar', 'blog2social') . '</a>';
        $content .='<br><span class="dashicons dashicons-calendar b2s-calendar-icon"></span><input style="width:88%;" id="b2s-post-meta-box-sched-date-picker" name="b2s-post-meta-box-sched-date" value="" readonly data-timepicker="true" data-language="' . esc_attr(substr(B2S_LANGUAGE, 0, 2)) . '" data-time-format="' . esc_attr($timeFormat) . '" data-date-format="' . esc_attr($dateFormat) . '" type="text"><br>';

        $content .="</div>";

        //Opt: Best Time Settings
        if (!empty($myBestTimeSettings) && is_array($myBestTimeSettings)) {
            $bestTimeSettings = array('type' => $bestTimeType, 'times' => $myBestTimeSettings);
            $content .="<input id='b2s-post-meta-box-best-time-settings' class='post-format' name='b2s-post-meta-box-best-time-settings' value='" . serialize($bestTimeSettings) . "' type='hidden'> ";
            $content .="<div class='b2s-post-meta-box-sched-best-time' style='display:none;'>";
            $content .="<span class='post-format-icon'>" . esc_html__('change', 'blog2social') . "</span>";
            $content .=' <a href="' . esc_attr($this->b2sSiteUrl . 'wp-admin/admin.php?page=blog2social-network') . '" target="_blank">' . esc_html__('best times', 'blog2social') . '</a></label>';
            $content .='<br><hr><span>' . esc_html__('Note: If you ???have??? not ???specified??? your own times, we automatically provide you with the best times to post??? on the social networks. You can always ???edit??? your own times in the settings.', 'blog2social') . '</span>';
            $content .="</div>";
        }

        $content .='</div>';
        return $content;
    }

}
