<? defined('C5_EXECUTE') or die("Access Denied."); ?>

<?
if (!is_array($messages)) {
	$messages = array();
}
$u = new User();
$ui = UserInfo::getByID($u->getUserID());

$editor = ConversationEditor::getActive();
$editor->setConversationObject($args['conversation']);

?>

<? if ($displayForm && ($displayPostingForm != 'bottom')) { ?>

<h4><?=t('Add Message')?></h4>

	<? if ($enablePosting) { ?>
		<div class="ccm-conversation-add-new-message" rel="main-reply-form">
			<form method="post" class="main-reply-form">
			<div class="ccm-conversation-avatar"><? print Loader::helper('concrete/avatar')->outputUserAvatar($ui)?></div>
			<div class="ccm-conversation-message-form">
				<div class="ccm-conversation-errors alert alert-error"></div>
				<? $editor->outputConversationEditorAddMessageForm(); ?>
				<button type="button" data-post-parent-id="0" data-submit="conversation-message" class="pull-right btn btn-submit btn-small"><?=t('Post')?> <i class="icon-bullhorn"></i></button>
				<a class="ccm-conversation-attachment-toggle" href="#"><?php echo t('Attach Files'); ?></a>
			</div>
			</form>
			<div class="ccm-conversation-attachment-container">
				<form action="<?php echo Loader::helper('concrete/urls')->getToolsURL('conversations/add_file');?>" class="dropzone" id="file-upload">
					<div class="ccm-conversation-errors alert alert-error"></div>
				</form>
			</div>
		</div>

		<div class="ccm-conversation-add-reply">
			<form method="post" class="aux-reply-form">
			<div class="ccm-conversation-avatar"><? print Loader::helper('concrete/avatar')->outputUserAvatar($ui)?></div>
			<div class="ccm-conversation-message-form">
				<div class="ccm-conversation-errors alert alert-error"></div>
				<? $editor->outputConversationEditorReplyMessageForm(); ?>
				<button type="button" data-submit="conversation-message" class="pull-right btn btn-submit btn-small"><?=t('Post')?> <i class="icon-bullhorn"></i></button>
				<a class="ccm-conversation-attachment-toggle" href="#"><?php echo t('Attach Files'); ?></a>
			</div>
			</form>
			<div class="ccm-conversation-attachment-container">
				<form action="<?php echo Loader::helper('concrete/urls')->getToolsURL('conversations/add_file');?>" class="dropzone" id="file-upload-reply">
					<div class="ccm-conversation-errors alert alert-error"></div>
				</form>
			</div>
		</div>
	<? } else { ?>
		<p><?=t('Adding new posts is disabled for this conversation.')?></p>
	<? } ?>

<? } ?>

<div class="ccm-conversation-message-list ccm-conversation-messages-<?=$displayMode?>">

	<div class="ccm-conversation-delete-message" data-dialog-title="<?=t('Delete Message')?>" data-cancel-button-title="<?=t('Cancel')?>" data-confirm-button-title="<?=t('Delete Message')?>">
		<?=t('Remove this message? Replies to it will not be removed.')?>
	</div>
	<div class="ccm-conversation-delete-attachment" data-dialog-title="<?=t('Delete Attachment')?>" data-cancel-button-title="<?=t('Cancel')?>" data-confirm-button-title="<?=t('Delete Attachment')?>">
		<?=t('Remove this attachment?')?>
	</div>
	<div class="ccm-conversation-message-permalink" data-dialog-title="<?=t('Link')?>" data-cancel-button-title="<?=t('Close')?>">
	</div>


	<div class="ccm-conversation-messages-header">
		<? if ($enableOrdering) { ?>
		<select class="ccm-sort-conversations" data-sort="conversation-message-list">
			<option value="date_asc" <? if ($orderBy == 'date_asc') { ?>selected="selected"<? } ?>><?=t('Earliest First')?></option>
			<option value="date_desc" <? if ($orderBy == 'date_desc') { ?>selected="selected"<? } ?>><?=t('Most Recent First')?></option>
			<option value="rating" <? if ($orderBy == 'rating') { ?>selected="selected"<? } ?>><?=t('Highest Rated')?></option>
		</select>
		<? } ?>

		<? Loader::element('conversation/count_header', array('conversation' => $conversation))?>
	</div>


	<div class="ccm-conversation-no-messages well well-small" <? if (count($messages) > 0) { ?>style="display: none" <? } ?>><?=t('No messages in this conversation.')?></div>

	<div class="ccm-conversation-messages">

	<? foreach($messages as $m) {
		Loader::element('conversation/message', array('cID' => $cID, 'message' => $m, 'enablePosting' => $enablePosting, 'displayMode' => $displayMode, 'enableCommentRating' => $enableCommentRating));
	} ?>

	</div>

	<? if ($totalPages > $currentPage) { ?>
	<div class="ccm-conversation-load-more-messages">
		<button class="btn btn-large" type="button" data-load-page="conversation-message-list" data-total-pages="<?=$totalPages?>" data-next-page="<?=$currentPage + 1?>" ><?=t('Load More')?></button>
	</div>
	<? } ?>


</div>

</div>

<? if ($displayForm && ($displayPostingForm == 'bottom')) { ?>

<h4><?=t('Add Message')?></h4>

	<? if ($enablePosting) { ?>
		<div class="ccm-conversation-add-new-message" rel="main-reply-form">
			<form method="post" class="main-reply-form">
			<div class="ccm-conversation-avatar"><? print Loader::helper('concrete/avatar')->outputUserAvatar($ui)?></div>
			<div class="ccm-conversation-message-form">
				<div class="ccm-conversation-errors alert alert-error"></div>
				<? $editor->outputConversationEditorAddMessageForm(); ?>
				<button type="button" data-post-parent-id="0" data-submit="conversation-message" class="pull-right btn btn-submit btn-small"><?=t('Post')?> <i class="icon-bullhorn"></i></button>
				<a class="ccm-conversation-attachment-toggle" href="#"><?php echo t('Attach Files'); ?></a>
			</div>
			</form>
			<div class="ccm-conversation-attachment-container">
				<form action="<?php echo Loader::helper('concrete/urls')->getToolsURL('conversations/add_file');?>" class="dropzone" id="file-upload">
				</form>
			</div>
		</div>

		<div class="ccm-conversation-add-reply">
			<form method="post" class="aux-reply-form">
			<div class="ccm-conversation-avatar"><? print Loader::helper('concrete/avatar')->outputUserAvatar($ui)?></div>
			<div class="ccm-conversation-message-form">
				<div class="ccm-conversation-errors alert alert-error"></div>
				<? $editor->outputConversationEditorReplyMessageForm(); ?>
				<button type="button" data-submit="conversation-message" class="pull-right btn btn-submit btn-small"><?=t('Post')?> <i class="icon-bullhorn"></i></button>
				<a class="ccm-conversation-attachment-toggle" href="#"><?php echo t('Attach Files'); ?></a>
			</div>
			</form>
			<div class="ccm-conversation-attachment-container">
				<form action="<?php echo Loader::helper('concrete/urls')->getToolsURL('conversations/add_file');?>" class="dropzone" id="file-upload-reply">
				</form>
			</div>
		</div>
	<? } else { ?>
		<p><?=t('Adding new posts is disabled for this conversation.')?></p>
	<? } ?>

<? } ?>
