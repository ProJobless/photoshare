
<?= form_open_multipart('photo/upload') ?>

<p>
<label for="photo-title">Title</label>
<?= form_input('photo_title') ?>
</p>

<p>
<?= form_label('Upload photo') ?> 
<?= form_upload('photo') ?>
</p>

<p><input type="submit" value="Upload Image" /></p>
</form>

<p><?php if (isset($error)) echo $error; ?></p>
