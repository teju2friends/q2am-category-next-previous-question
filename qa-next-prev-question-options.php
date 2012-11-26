<?php
/*
*	Q2AM Next Previous Question
*
*	Add next previous question link to the question page.
*	File: Plugin options
*	
*	@author			Q2A Market
*	@category		Plugin
*	@Version: 		1.0
*	
*	@Q2A Version	1.5.3
*
*	Do not modify this file unless you know what you are doing
*/

class qa_next_prev_question_options {

	function allow_template($template)
	{
		return ($template!='admin');
	}

	function option_default($option) {

		switch($option) {

			case 'button_style':
				return 'theme';

			case 'previous_lable':
				return '&larr; Prev Question';

			case 'next_lable':
				return 'Next Question &rarr;';

			default:
				return null;

		}	

	}
	
	function admin_form(&$qa_content)
	{

		$ok = null;
		if (qa_clicked('np_q_save_button')) {
			
			qa_opt('show_on_top',(bool)qa_post_text('show_on_top'));
			qa_opt('show_on_bottom',(bool)qa_post_text('show_on_bottom'));
			qa_opt('button_style', qa_post_text('button_style'));
			qa_opt('previous_lable', qa_post_text('previous_lable'));
			qa_opt('next_lable', qa_post_text('next_lable'));
			
			
			$ok = qa_lang('admin/options_saved');
		}
		else if (qa_clicked('np_q_reset_button')) {
			foreach($_POST as $i => $v) {
				$def = $this->option_default($i);
				if($def !== null) qa_opt($i,$def);
			}
			$ok = qa_lang('admin/options_reset');
		}			
		

		$fields = array();

		$button_style = array(

			'theme'			=>	'theme',
			'grey'			=>	'grey',
			'blue' 			=> 	'blue',
			'red' 			=> 	'red',
			'orange'		=>	'orange',
			'green' 		=> 	'green',
			'yellow' 		=> 	'yellow',
			'black' 		=> 	'black',
			'clean' 		=> 	'clean',
			'radius' 		=> 	'radius',
			'round' 		=> 	'round',
			'glossy-blue' 	=> 	'glossy-blue',
			'glossy-green' 	=> 	'glossy-green',
			'glossy-red' 	=> 	'glossy-red',
			'glossy-black' 	=> 	'glossy-black'			
		);

		$fields[] = array(
			'label' => 'Show on top',
			'tags' => 'NAME="show_on_top"',
			'value' => qa_opt('show_on_top'),
			'type' => 'checkbox',
		);

		$fields[] = array(
			'label' => 'Show on bottom',
			'tags' => 'NAME="show_on_bottom"',
			'value' => qa_opt('show_on_bottom'),
			'type' => 'checkbox',
		);
			
		$fields[] = array(
			'label' => 'Button Style',
			'tags' => 'NAME="button_style" title="how long you want to show slide"',
			'id' => 'button_style',
			'type' => 'select',
			'options' => $button_style,
			'value' => qa_opt('button_style'),
		);

		$fields[] = array(
			'id' => 'previous_lable',
			'label' => 'Previous label',
			'type' => 'text',
			'value' => qa_opt('previous_lable'),
			'tags' => 'NAME="previous_lable"',
		);

		$fields[] = array(
			'id' => 'next_lable',
			'label' => 'Next label',
			'type' => 'text',
			'value' => qa_opt('next_lable'),
			'tags' => 'NAME="next_lable"',
		);

		$fields[] = array(
			'type' => 'blank',
		);

		return array(
			'ok' => ($ok && !isset($error)) ? $ok : null,
			
			'fields' => $fields,
			
			'buttons' => array(
				array(
				'label' => qa_lang_html('main/save_button'),
				'tags' => 'NAME="np_q_save_button"',
				),
				array(
				'label' => qa_lang_html('admin/reset_options_button'),
				'tags' => 'NAME="np_q_reset_button"',
				),
			),
		);
	}

}