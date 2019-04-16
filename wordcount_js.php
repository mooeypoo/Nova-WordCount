<?php
/**
 * Add word count to Nova mission posts.
 * @author Moriel Schottlender mooeypoo@gmail.com
 */
$reqSettings = [
	'logcountLimit' => 'Word count limit',
	'logcountLimitMessage' => 'Message appearing when the word count is over the limit.'
];
$settings = [];
foreach ( $reqSettings as $setName => $setDesc ) {
	$setValue = $this->settings->get_setting( $setName );
	if ( $setValue === false ) {
		// Add the setting key
		$this->settings->add_new_setting( [
			'setting_key' => $setName,
			'setting_label' => 'WordCount extension. ' . $setDesc,
			'setting_value' => ''
		] );
		$setValue = '';
	}
	if ( $setName === 'logcountLimitMessage' ) {
		$setValue = htmlspecialchars($setValue);
	} else if ( $setName === 'logcountLimit' ) {
		$setValue = intval( $setValue );
	}
	$settings[$setName] = $setValue;
}
?>
<script type="text/javascript">
/**
 * Add a wordcount counter to the mission post box with a friendly
 * 'warning' when a post goes over some limit that is defined in the settings.
 *
 * If no limit is defined, the code will fall back to having no limit
 * message at all.
 *
 * NOTE: This does not actually limit users in anything; the 'limit' is simply
 * a way to show a note to the user encouraging them to split the post to parts.
 *
 * INSTALLATION:
 * In order to set a word limit, please add these setting keys to user-defined
 * settings in Nova:
 * * 'logcountLimit' (Numerical) The number of words to limit. 0 for no limit.
 * * 'logcountLimitMessage' (String) The message to display in case the post goes
 * above the limit.
 *
 * @author Moriel Schottlender mooeypoo@gmail.com
 */
$( document ).ready( function (){
	var logcountLimit, logcountLimitMessage,
		$wordCountContainer,
		$textarea = $( '#writepost #content-textarea' ),
		calcWordCount = function ( text ) {
			var words, chars;

			text = $.trim( text );

			if ( text.length === 0 ) {
				words = 0;
				chars = 0;
			} else {
				words = text.replace(/\s+/gi, ' ').split(' ').length || 0,
				chars = text.length
			}
			return {
				'w': words,
				'c': chars
			};
		},
		updateWordcountMessage = function ( wordCountObject ) {
			var aboveLimit, splitMsg;

			wordCountObject = wordCountObject || { 'w': 0, 'c': 0 };

			aboveLimit = logcountLimit > 0 && wordCountObject.w >= logcountLimit;
			splitMsg = aboveLimit ? logcountLimitMessage : '';

			// Update message
			$wordCountContainer
				.text( wordCountObject.w + ' words, ' + wordCountObject.c + ' characters. '  + splitMsg )
				.toggleClass( 'flash-error', aboveLimit );
		};
	logcountLimit = <?php echo $settings['logcountLimit']; ?>;
	logcountLimitMessage = '<?php echo $settings['logcountLimitMessage']; ?>';

	$wordCountContainer = $( '<div>' )
		.addClass( 'content-wordcount' )

	// Attach to document
	$textarea.parent().append( $wordCountContainer );

	// Initial count
	updateWordcountMessage( calcWordCount( $textarea.val() ) );

	// Update on input
	$textarea.on( 'input', function() {
		updateWordcountMessage( calcWordCount( $( this ).val() ) );
	} );
} );

</script>
