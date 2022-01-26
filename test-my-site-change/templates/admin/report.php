<?php

class pagination{
/*
Script Name: *Digg Style Paginator Class
Script URI: http://www.mis-algoritmos.com/2007/05/27/digg-style-pagination-class/
Description: Class in PHP that allows to use a pagination like a digg or sabrosus style.
Script Version: 0.4
Author: Victor De la Rocha
Author URI: http://www.mis-algoritmos.com
*/
		/*Default values*/
		var $total_pages = -1;//items
		var $limit = null;
		var $target = ""; 
		var $page = 1;
		var $adjacents = 2;
		var $showCounter = false;
		var $className = "bmg-pagination";
		var $parameterName = "page";
		var $urlF = false;//urlFriendly

		/*Buttons next and previous*/
		var $nextT = "Next";
		var $nextI = "&#187;"; //&#9658;
		var $prevT = "Previous";
		var $prevI = "&#171;"; //&#9668;

		/*****/
		var $calculate = false;
		
		#Total items
		function items($value){$this->total_pages = (int) $value;}
		
		#how many items to show per page
		function limit($value){$this->limit = (int) $value;}
		
		#Page to sent the page value
		function target($value){$this->target = $value;}
		
		#Current page
		function currentPage($value){$this->page = (int) $value;}
		
		#How many adjacent pages should be shown on each side of the current page?
		function adjacents($value){$this->adjacents = (int) $value;}
		
		#show counter?
		function showCounter($value=""){$this->showCounter=($value===true)?true:false;}

		#to change the class name of the pagination div
		function changeClass($value=""){$this->className=$value;}

		function nextLabel($value){$this->nextT = $value;}
		function nextIcon($value){$this->nextI = $value;}
		function prevLabel($value){$this->prevT = $value;}
		function prevIcon($value){$this->prevI = $value;}

		#to change the class name of the pagination div
		function parameterName($value=""){$this->parameterName=$value;}

		#to change urlFriendly
		function urlFriendly($value="%"){
				if(eregi('^ *$',$value)){
						$this->urlF=false;
						return false;
					}
				$this->urlF=$value;
			}
		
		var $pagination;

		function pagination(){}
		function show(){
				if(!$this->calculate)
					if($this->calculate())
						echo "<div class=\"$this->className\">$this->pagination</div>\n";
			}
		function getpagination() {
			$output = '';
			if(!$this->calculate)
					if($this->calculate())
						$output .= "<div class=\"$this->className\">$this->pagination</div>\n";
			return $output;		
		}	
		function getOutput(){
				if(!$this->calculate)
					if($this->calculate())
						return "<div class=\"$this->className\">$this->pagination</div>\n";
			}
		function get_pagenum_link($id){
				if(strpos($this->target,'?')===false)
						if($this->urlF)
								return str_replace($this->urlF,$id,$this->target);
							else
								return "$this->target?$this->parameterName=$id";
					else
						return "$this->target&$this->parameterName=$id";
			}
		
		function calculate(){
				$this->pagination = "";
				$this->calculate == true;
				$error = false;
				if($this->urlF and $this->urlF != '%' and strpos($this->target,$this->urlF)===false){
						//Es necesario especificar el comodin para sustituir
						echo "Especificaste un wildcard para sustituir, pero no existe en el target<br />";
						$error = true;
					}elseif($this->urlF and $this->urlF == '%' and strpos($this->target,$this->urlF)===false){
						echo "Es necesario especificar en el target el comodin % para sustituir el número de página<br />";
						$error = true;
					}

				if($this->total_pages < 0){
						echo "It is necessary to specify the <strong>number of pages</strong> (\$class->items(1000))<br />";
						$error = true;
					}
				if($this->limit == null){
						echo "It is necessary to specify the <strong>limit of items</strong> to show per page (\$class->limit(10))<br />";
						$error = true;
					}
				if($error)return false;
				
				$n = trim($this->nextT.' '.$this->nextI);
				$p = trim($this->prevI.' '.$this->prevT);
				
				/* Setup vars for query. */
				if($this->page) 
					$start = ($this->page - 1) * $this->limit;             //first item to display on this page
				else
					$start = 0;                                //if no page var is given, set start to 0
			
				/* Setup page vars for display. */
				$prev = $this->page - 1;                            //previous page is page - 1
				$next = $this->page + 1;                            //next page is page + 1
				$lastpage = ceil($this->total_pages/$this->limit);        //lastpage is = total pages / items per page, rounded up.
				$lpm1 = $lastpage - 1;                        //last page minus 1
				
				/* 
					Now we apply our rules and draw the pagination object. 
					We're actually saving the code to a variable in case we want to draw it more than once.
				*/
				
				if($lastpage > 1){
						if($this->page){
								//anterior button
								if($this->page > 1)
										$this->pagination .= "<a href=\"".$this->get_pagenum_link($prev)."\" class=\"prev\">$p</a>";
									else
										$this->pagination .= "<span class=\"disabled\">$p</span>";
							}
						//pages	
						if ($lastpage < 7 + ($this->adjacents * 2)){//not enough pages to bother breaking it up
								for ($counter = 1; $counter <= $lastpage; $counter++){
										if ($counter == $this->page)
												$this->pagination .= "<span class=\"current\">$counter</span>";
											else
												$this->pagination .= "<a href=\"".$this->get_pagenum_link($counter)."\">$counter</a>";
									}
							}
						elseif($lastpage > 5 + ($this->adjacents * 2)){//enough pages to hide some
								//close to beginning; only hide later pages
								if($this->page < 1 + ($this->adjacents * 2)){
										for ($counter = 1; $counter < 4 + ($this->adjacents * 2); $counter++){
												if ($counter == $this->page)
														$this->pagination .= "<span class=\"current\">$counter</span>";
													else
														$this->pagination .= "<a href=\"".$this->get_pagenum_link($counter)."\">$counter</a>";
											}
										$this->pagination .= "...";
										$this->pagination .= "<a href=\"".$this->get_pagenum_link($lpm1)."\">$lpm1</a>";
										$this->pagination .= "<a href=\"".$this->get_pagenum_link($lastpage)."\">$lastpage</a>";
									}
								//in middle; hide some front and some back
								elseif($lastpage - ($this->adjacents * 2) > $this->page && $this->page > ($this->adjacents * 2)){
										$this->pagination .= "<a href=\"".$this->get_pagenum_link(1)."\">1</a>";
										$this->pagination .= "<a href=\"".$this->get_pagenum_link(2)."\">2</a>";
										$this->pagination .= "...";
										for ($counter = $this->page - $this->adjacents; $counter <= $this->page + $this->adjacents; $counter++)
											if ($counter == $this->page)
													$this->pagination .= "<span class=\"current\">$counter</span>";
												else
													$this->pagination .= "<a href=\"".$this->get_pagenum_link($counter)."\">$counter</a>";
										$this->pagination .= "...";
										$this->pagination .= "<a href=\"".$this->get_pagenum_link($lpm1)."\">$lpm1</a>";
										$this->pagination .= "<a href=\"".$this->get_pagenum_link($lastpage)."\">$lastpage</a>";
									}
								//close to end; only hide early pages
								else{
										$this->pagination .= "<a href=\"".$this->get_pagenum_link(1)."\">1</a>";
										$this->pagination .= "<a href=\"".$this->get_pagenum_link(2)."\">2</a>";
										$this->pagination .= "...";
										for ($counter = $lastpage - (2 + ($this->adjacents * 2)); $counter <= $lastpage; $counter++)
											if ($counter == $this->page)
													$this->pagination .= "<span class=\"current\">$counter</span>";
												else
													$this->pagination .= "<a href=\"".$this->get_pagenum_link($counter)."\">$counter</a>";
									}
							}
						if($this->page){
								//siguiente button
								if ($this->page < $counter - 1)
										$this->pagination .= "<a href=\"".$this->get_pagenum_link($next)."\" class=\"next\">$n</a>";
									else
										$this->pagination .= "<span class=\"disabled\">$n</span>";
									if($this->showCounter)$this->pagination .= "<div class=\"pagination_data\">($this->total_pages Pages)</div>";
							}
					}

				return true;
			}
	}




global $wpdb;
$table =  $wpdb->prefix . 'posts';

$result = $wpdb->get_results("SELECT * FROM $table WHERE post_type = 'testmysite'");

$items = $wpdb->num_rows;
					$rows_limit = 10;
					$p = new pagination;
					$limit = '';
					if($items > 0 && $result) {
						
						$p->items($items);
						$p->limit($rows_limit); // Limit entries per page
						$p->target("admin.php?page=testmysite"); 
						$p->currentPage(isset($_GET['paging'])); // Gets and validates the current page
						$p->calculate(); // Calculates what to show
						$p->parameterName('paging');
						$p->adjacents(1); //No. of page away from the current page
								 
						if(!isset($_GET['paging'])) {
							$p->page = 1;
						} else {
							$p->page = $_GET['paging'];
						}
						 
						//Query for limit paging
						$limit = "LIMIT " . ($p->page - 1) * $p->limit  . ", " . $p->limit;
						 
				}

				if(isset($_POST['delete'])) {
					$row_array = $_POST['post'];
					$row_ids = implode(', ', $row_array);

					
					
					$delete_sql = "DELETE from $table WHERE id IN ($row_ids)";
					$delete_result = $wpdb->query($delete_sql);
					if($delete_result) {
							$message = count($row_array) . " form(s) deleted.";
					} 
				}


				$query = "SELECT * FROM $table WHERE post_type = 'testmysite'"; 
				$result = $wpdb->get_results($query);





?>

<div class="wrap">
	<h1 class="wp-heading-inline">Test My Site Report</h1>
	<form method="post" name="bmg_frm">
<div class="tablenav top">
	<div class="alignleft bulkactions">
		<input type="submit" id="doaction" name="delete" class="button" value="Delete">
	</div>
	<div class="tablenav-pages">
				<?php
		 if($items > 0) { ?>
                    <div class="">
                        <nav class=''>
                            <?php  echo $p->show();  // Echo out the list of paging. ?>
                        </nav>
                    </div>
                    <?php } ?>
				
			</div>
			<br class="clear" />
	</div>

	<table class="wp-list-table widefat fixed striped posts">
		<thead>
			<tr>
				<td class="manage-column column-cb check-column">
					<label class="screen-reader-text" for="cb-select-all-1">Select All</label>
					<input id="cb-select-all-1" type="checkbox">
				</td>
				<th class="manage-column column-title column-primary">
					<b>Form</b>
				</th>
				<th class="manage-column column-title column-primary">
					<b>Shortcode</b>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if($result) {
	foreach($result as $row) {
						?>
			<tr>
				<th scope="row" class="check-column">	
				
					<label class="screen-reader-text" for="cb-select-<?php echo $row->ID; ?>">Select <?php echo $row->post_title; ?></label>									
					<input id="cb-select-<?php echo $row->id; ?>" type="checkbox" name="post[]" value="<?php echo $row->id; ?>">
			
					</th>
				<td>
					<?php
						echo $row->post_title;
					?>
				</td>
				<td>
					[asx_forms <?php echo 'Id="' . $row->id . '"'; ?>]
					<a href="<?php  echo esc_html( admin_url('admin.php?page=bmg_mail_config&form_id=' ) ) . $row->id; ?>" class="btn btn-primary btn-sm pull-right">Mail Config</a>
					<a href="<?php  echo esc_html( admin_url('admin.php?page=bmg_edit_form&form_id=' ) ) . $row->id; ?>" class="btn btn-success btn-sm pull-right mr-2">Edit</a>
				</td>
				
			</tr>
			<?php
				}
			} else {?>
				<tr>
					<td colspan="3" class="text-center">No Reports found.</td>
				</tr>

			<?php
			}	
			?>		
		</tbody>
	</table>

	*/ ?>
</form>
</div>