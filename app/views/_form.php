<div class="content"><form action="" method="post">
<input type="hidden" name="id" value="<?php echo isset($form->id) ? $form->id : ''; ?>"/>
<label for="form_name"><?php echo __('Title', 'form'); ?></label>
<input type="text" name="name" id="form_name" value="<?php echo isset($form->name) ? $form->name : ''; ?>"/>
<label for="form_body"><?php echo __('Body', 'form'); ?></label>
<textarea name="body" id="form_body"><?php echo  isset($form->body) ? $form->body : ''; ?></textarea>
<label for="form_tags"><?php echo __('Tags', 'form'); ?></label>
<input type="text" name="tags" id="form_tags" value="<?php echo isset($form->tags) ? $form->tags : ''; ?>"/>
<input type="submit" value="<?php echo __('Save changes', 'form'); ?>" />
</form>
</div>
