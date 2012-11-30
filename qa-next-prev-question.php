<?php
/*
*	Q2AM Next Previous Question
*
*	Add next previous question link to the question page.
*	File: Plugin output
*	
*	@author			Q2A Market
*	@category		Plugin
*	@Version: 		1.0
*	
*	@Q2A Version	1.5.3
*
*	Do not modify this file unless you know what you are doing
*/

class qa_html_theme_layer extends qa_html_theme_base {


	function head_css() {
		qa_html_theme_base::head_css();
		$plugin_root = qa_opt('site_url').'qa-plugin/q2am-next-previous-question/'; 
		$this->output('<LINK REL="stylesheet" TYPE="text/css" HREF="'.$plugin_root.'q2am-np-style.css"/>');		
	}


	function get_prev_q(){
	
		$myurl=$this->request;
		$myurlpieces = explode("/", $myurl);
		$myurl=$myurlpieces[0];
	
		$query_p = "SELECT * 
					FROM ^posts 
					WHERE postid < $myurl
					AND type='Q'
					ORDER BY postid DESC
					LIMIT 1";

		$prev_q = qa_db_query_sub($query_p);
		
		while($prev_link = qa_db_read_one_assoc($prev_q, true)){
			
			$title = $prev_link['title'];
			$pid = $prev_link['postid'];
			
			$this->output('<A HREF="'. qa_q_path_html($pid, $title) .'" title="'. $title .'" CLASS="qa-prev-q '.qa_opt('button_style').'">'.qa_opt('previous_lable').'</A>');

			// echo '<A HREF="'. qa_q_path_html($pid, $title) .'" title="'. $title .'" CLASS="qa-prev-q '.qa_opt('button_style').'">&larr; Prev Question</A>';
		}
		
	}
	

	function get_next_q(){	
		
		$myurl=$this->request;
		$myurlpieces = explode("/", $myurl);
		$myurl=$myurlpieces[0];
		 
		
		$query_n = "SELECT * 
					FROM ^posts 
					WHERE postid > $myurl
					AND type='Q'
					ORDER BY postid ASC
					LIMIT 1";

		$next_q = qa_db_query_sub($query_n);
		
		while($next_link = qa_db_read_one_assoc($next_q, true)){
			
			$title = $next_link['title'];
			$pid = $next_link['postid'];

			$this->output('<A HREF="'. qa_q_path_html($pid, $title) .'" title="'. $title .'" CLASS="qa-next-q '.qa_opt('button_style').'">'.qa_opt('next_lable').'</A>');
			
			//echo '<A HREF="'. qa_q_path_html($pid, $title) .'" title="'. $title .'" CLASS="qa-next-q '.qa_opt('button_style').'">Next Question &rarr;</A>';
		}

	}			

	function q_view($q_view){

		if(qa_opt('show_on_top')){

			$this->output('<DIV CLASS="q2am-next-prev-question clearfix">');
			$this->get_prev_q();
			$this->get_next_q();
			$this->output('</DIV><!-- END q2am-next-prev-question -->');

		}

		qa_html_theme_base::q_view($q_view);
		
	}


	function a_list($a_list){

		qa_html_theme_base::a_list($a_list);

		if(qa_opt('show_on_bottom')) {

			$this->output('<DIV CLASS="q2am-next-prev-question">');
			$this->get_prev_q();
			$this->get_next_q();
			$this->output('</DIV><!-- END q2am-next-prev-question -->');

		}
	}


}