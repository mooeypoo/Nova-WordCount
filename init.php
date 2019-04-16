<?php
/*!
 * WordCount for Anodyne Nova 2
 *
 * An extension that displays a warning message when a mission post
 * is over some defined word count value.
 */
$this->event->listen(['template', 'render', 'data' ], function ($event) {
	if (
		$this->uri->segment(1) === 'write' &&
		$this->uri->segment(2) === 'missionpost'
	) {
		$path = APPPATH.'extensions/WordCount/wordcount_js.php';
		$output = $this->ci->load->_ci_load(array(
			'_ci_vars' => $this->ci->load->_ci_object_to_array( [] ),
			'_ci_path' => $path,
			'_ci_return' => true
		));
		$event['data']['javascript'] .= $output;
	}
} );
