<?php include 'header.php'; ?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <div class="container mt-4">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2 class="text-center text-primary">Home Images</h2>
                        <a href="home_ads.php" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                            <i class="fa-solid fa-upload"></i> Add Image
                        </a>
                    </div>

                    <table class="table table-bordered mt-3">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>S.no</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Position</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="homeAdsTable">
                            <?php
                            include '../../db.connection/db_connection.php';

                            $query = "SELECT * FROM home_ads ORDER BY type ASC, id ASC"; // Sort Upper first
                            $result = mysqli_query($conn, $query);
                            $sno = 1;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $imagePath = !empty($row['image']) ? "../uploads/home_ads/{$row['image']}" : "default.jpg";

                                echo "<tr data-id='{$row['id']}' data-position='{$row['type']}'>
                                    <td class='sno'>{$sno}</td>
                                    <td class='title-text'>{$row['title']}</td>
                                    <td><img src='{$imagePath}' alt='Ad Image' class='img-thumbnail' width='100' height='100'></td>
                                    <td class='position-text'>" . ucfirst($row['type']) . " Image</td> 
                                    <td>{$row['created_at']}</td>
                                    <td>
                                        <button class='btn btn-warning btn-sm edit-btn' 
                                            data-id='{$row['id']}' 
                                            data-title='{$row['title']}' 
                                            data-image='{$row['image']}'
                                            data-position='{$row['type']}'>Edit</button>
                                        <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['id']}'>Delete</button>
                                    </td>
                                </tr>";
                                $sno++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Home Ad</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm" enctype="multipart/form-data">
                                    <input type="hidden" id="editAdId" name="id">

                                    <label class="form-label">Title:</label>
                                    <input type="text" class="form-control" id="editAdTitle" name="title" required>

                                    <label class="form-label mt-3">Current Image:</label>
                                    <div>
                                        <img id="currentImage" src="" class="img-thumbnail" width="100" height="100">
                                    </div>

                                    <label class="form-label mt-3">Display Position:</label>
                                    <select class="form-control" id="editAdPosition" name="position">
                                        <option value="upper">Upper Image</option>
                                        <option value="lower">Lower Image</option>
                                    </select>

                                    <label class="form-label mt-3">Choose New Image:</label>
                                    <input type="file" class="form-control" id="editAdImage" name="image">

                                    <div class="modal-footer mt-3">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- JavaScript -->
                <script>
                    $(document).ready(function() {
                        // Open Edit Modal
                        $('.edit-btn').click(function() {
                            let id = $(this).data('id');
                            let title = $(this).data('title');
                            let image = $(this).data('image');
                            let position = $(this).data('position');

                            $('#editAdId').val(id);
                            $('#editAdTitle').val(title);
                            $('#editAdPosition').val(position);
                            $('#currentImage').attr('src', '../uploads/home_ads/' + image);
                            $('#editAdImage').val(''); // Clear file input

                            $('#editModal').modal('show');
                        });

                        // Submit Edit Form
                        $('#editForm').submit(function(e) {
                            e.preventDefault();
                            let formData = new FormData(this);

                            $.ajax({
                                url: 'edit_home_ads.php',
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    if (response.trim() === 'success') {
                                        let id = $('#editAdId').val();
                                        let title = $('#editAdTitle').val();
                                        let newImage = $('#editAdImage')[0].files[0];
                                        let newPosition = $('#editAdPosition').val();

                                        let row = $('tr[data-id="' + id + '"]');

                                        row.find('.title-text').text(title);
                                        row.find('.position-text').text(newPosition.charAt(0).toUpperCase() + newPosition.slice(1) + ' Image');

                                        if (newImage) {
                                            let imageURL = URL.createObjectURL(newImage);
                                            row.find('img').attr('src', imageURL);
                                        }

                                        row.attr('data-position', newPosition);

                                        let allRows = $('#homeAdsTable tr').detach();
                                        let upperImages = allRows.filter('[data-position="upper"]');
                                        let lowerImages = allRows.filter('[data-position="lower"]');

                                        $('#homeAdsTable').append(upperImages).append(lowerImages);

                                        $('#homeAdsTable tr').each(function(index) {
                                            $(this).find('.sno').text(index + 1);
                                        });

                                        $('#editModal').modal('hide');
                                    } else {
                                        alert('Update failed: ' + response);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('AJAX Error: ', status, error);
                                    alert('An error occurred while updating. Please try again.');
                                }
                            });
                        });

                        // Delete Image
                        $('.delete-btn').click(function() {
                            if (!confirm('Are you sure you want to delete this record?')) return;

                            let id = $(this).data('id');
                            let row = $('tr[data-id="' + id + '"]');

                            $.post('delete_home_ads.php', { id: id }, function(response) {
                                if (response.trim() === 'success') {
                                    row.remove();
                                    $('#homeAdsTable tr').each(function(index) {
                                        $(this).find('.sno').text(index + 1);
                                    });
                                } else {
                                    alert('Delete failed. Please try again.');
                                }
                            }).fail(function(jqXHR, textStatus, errorThrown) {
                                console.error('AJAX Error: ', textStatus, errorThrown);
                                alert('An error occurred while deleting.');
                            });
                        });
                    });
                </script>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>
