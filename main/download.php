<?php
// Enable error reporting (for development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the file parameter is set
if (isset($_GET['file'])) {
    $file = basename($_GET['file']); // Prevent directory traversal
    $filePath = 'users/uploads/' . $file; // Update this path to your jobs directory

    // Check if the file exists
    if (file_exists($filePath)) {
        // Set headers to force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        // Clear the output buffer
        ob_clean();
        flush();
        readfile($filePath);
        exit;
    } else {
        echo 'File does not exist.';
    }
} else {
    echo 'No file specified.';
}
?>
