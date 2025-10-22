<div class="bottem active" id="announcements">

    <?php
    require_once __DIR__ . '/../../Controllers/announcementController.php';

    $announcementController = new AnnouncementController();
    $announcements = $announcementController->getAllAnnouncements();
    ?>

    <style>
        /* Popup Overlay */
        .popup-overlay {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .popup-overlay.active {
            display: flex;
        }

        .popup-content {
            background-color: #fff;
            border-radius: 8px;
            width: 90%;
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            animation: slideDown 0.3s;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>

    <?php
    $__mpDir = __DIR__;
    $__viewFile = $__mpDir . DIRECTORY_SEPARATOR . 'announcementSection' . DIRECTORY_SEPARATOR . 'announcementView.php';
    $__createFile = $__mpDir . DIRECTORY_SEPARATOR . 'announcementSection' . DIRECTORY_SEPARATOR . 'announcementCreate.php';

    if (file_exists($__viewFile)) {
        include_once $__viewFile;
    } else {
        error_log("announcementView.php not found at: " . $__viewFile);
    }

    if (file_exists($__createFile)) {
        include_once $__createFile;
    } else {
        error_log("announcementCreate.php not found at: " . $__createFile);
    }
    ?>
    asdkfjosifjo

    <script>
        function openPopup(announcement) {
            // Fill the form with announcement data
            document.getElementById('edit_announcement_id').value = announcement.announcement_id;
            document.getElementById('edit_announcementTitle').value = announcement.title;
            document.getElementById('edit_announcementMessage').value = announcement.content;
            document.getElementById('edit_targetAudience').value = announcement.audienceID;

            // Show the popup
            document.getElementById("popupForm").classList.add("active");
            document.body.style.overflow = 'hidden';
        }

        function closePopup() {
            document.getElementById("popupForm").classList.remove("active");
            document.body.style.overflow = 'auto';
        }

        // Close popup when clicking outside
        window.onclick = function (event) {
            const popup = document.getElementById('popupForm');
            if (event.target === popup) {
                closePopup();
            }
        }

        // Close popup with Escape key
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closePopup();
            }
        });
    </script>