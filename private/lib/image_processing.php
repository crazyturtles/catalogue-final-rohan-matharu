<?php
function process_image_upload($image, &$error_message = '')
{
    $upload_dir = '../../public/uploads/images/';
    $full_dir = $upload_dir . 'full/';
    $thumb_dir = $upload_dir . 'thumbs/';

    $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
    $file_extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($file_extension, $allowed_extensions)) {
        $error_message = "You cannot upload files of this type. Allowed types: JPG, PNG, WebP";
        return false;
    }

    if (!in_array($image['type'], $allowed_types)) {
        $error_message = "Invalid image format. Allowed formats: JPG, PNG, WebP";
        return false;
    }

    if ($image['error'] !== 0) {
        $error_message = "There was an error uploading your file. Error code: " . $image['error'];
        return false;
    }

    if ($image['size'] > 2000000) {
        $error_message = "The file is too large. Maximum size: 2MB";
        return false;
    }

    $filename = uniqid('match_', true) . '.' . $file_extension;
    $source = imagecreatefromstring(file_get_contents($image['tmp_name']));
    if (!$source) {
        $error_message = "Failed to process image file";
        return false;
    }

    $source_width = imagesx($source);
    $source_height = imagesy($source);

    // Create full-size version (720px wide)
    $ratio = $source_height / $source_width;
    $target_width = 720;
    $target_height = (int) floor($target_width * $ratio);

    $full = imagecreatetruecolor($target_width, $target_height);
    if (!imagecopyresampled($full, $source, 0, 0, 0, 0, $target_width, $target_height, $source_width, $source_height)) {
        $error_message = "Failed to resize image";
        imagedestroy($source);
        return false;
    }

    if (!imagejpeg($full, $full_dir . $filename, 80)) {
        $error_message = "Failed to save full-size image";
        imagedestroy($source);
        imagedestroy($full);
        return false;
    }

    // Create square thumbnail (300x300)
    $thumb_size = 300;
    $thumbnail = imagecreatetruecolor($thumb_size, $thumb_size);

    // Calculate center crop coordinates
    $source_aspect = $source_width / $source_height;
    if ($source_aspect > 1) {
        // Landscape
        $crop_width = $source_height;
        $crop_height = $source_height;
        $x_offset = ($source_width - $crop_width) / 2;
        $y_offset = 0;
    } else {
        // Portrait
        $crop_width = $source_width;
        $crop_height = $source_width;
        $x_offset = 0;
        $y_offset = ($source_height - $crop_height) / 2;
    }

    if (
        !imagecopyresampled(
            $thumbnail,
            $source,
            0,
            0,
            $x_offset,
            $y_offset,
            $thumb_size,
            $thumb_size,
            $crop_width,
            $crop_height
        )
    ) {
        $error_message = "Failed to create thumbnail";
        imagedestroy($source);
        imagedestroy($full);
        imagedestroy($thumbnail);
        return false;
    }

    if (!imagejpeg($thumbnail, $thumb_dir . $filename, 80)) {
        $error_message = "Failed to save thumbnail";
        imagedestroy($source);
        imagedestroy($full);
        imagedestroy($thumbnail);
        return false;
    }

    imagedestroy($source);
    imagedestroy($full);
    imagedestroy($thumbnail);

    return $filename;
}

function delete_match_images($filename)
{
    $full_path = '/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/public/uploads/images/full/' . $filename;
    $thumb_path = '/home/rmatharu2/public_html/dmit2025/catalogue-final-rohan-matharu/public/uploads/images/thumbs/' . $filename;

    if (file_exists($full_path)) {
        unlink($full_path);
    }
    if (file_exists($thumb_path)) {
        unlink($thumb_path);
    }
    return true;
}
?>