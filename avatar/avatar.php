
<form action="upload_process.php" method="POST" enctype="multipart/form-data" autocomplete="off">
<div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $row['post_img']; ?>" height="150px">
                <input type="hidden" name="old_image" value="<?php echo $row['post_img']; ?>">
            </div>
            <input type="submit" name="submit" id="btn" value="Update" />
        </form>
