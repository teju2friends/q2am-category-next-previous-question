<?php

/*
	Plugin Name: Q2AM Next Previous Question
	Plugin URI: http://www.q2amarket.com
	Plugin Update Check URI: http://www.q2amarket.com/meta/update/plugins/q2am-recent-questions/qa-plugin.php
	Plugin Description: Add next previous question link to the question page.
	Plugin Version: 1.0
	Plugin Date: 2012-11-26
	Plugin Author: Q2A Market
	Plugin Author URI: http://www.q2amarket.com
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.4
*/


if (!defined('QA_VERSION')){header('Location: ../../'); exit;}

qa_register_plugin_layer('qa-next-prev-question.php', 'Next Previous Question');

qa_register_plugin_module('module', 'qa-next-prev-question-options.php', 'qa_next_prev_question_options', 'Q2A Market - Next Previous Question Options');