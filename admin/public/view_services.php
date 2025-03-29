<?php include 'header.php'; ?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <?php include 'navbar.php'; ?>

        <div id="content">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Available Services</h1>
                    <a href="add_service.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fa-solid fa-plus"></i> Add Service
                    </a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="row row-custom no-gutters col-12">
                            <?php include '../../db.connection/db_connection.php'; ?>

                            <div class="container mt-4">
                                <h2 class="text-center text-primary">Available Services</h2>

                                <table class="table table-bordered mt-3">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>S.No</th>
                                            <th>Service Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="servicesTable">
                                        <?php
                                        $query = "SELECT * FROM services";
                                        $result = mysqli_query($conn, $query);
                                        $sno = 1; // Serial number starts from 1

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr data-id='{$row['id']}'>
                                                    <td class='serial-number'>{$sno}</td>
                                                    <td class='service-name'>{$row['name']}</td>
                                                    <td>
                                                        <a href='{$row['slug']}.php?id={$row['id']}' class='btn btn-primary btn-sm'>View</a>
                                                        <button class='btn btn-warning btn-sm edit-btn' data-id='{$row['id']}' data-name='{$row['name']}'>Edit</button>
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
                                            <h5 class="modal-title" id="editModalLabel">Edit Service</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" id="editServiceId">
                                            <label class="form-label">Service Name:</label>
                                            <input type="text" class="form-control" id="editServiceName">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" id="saveEditBtn">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <script>
                                $(document).ready(function() {
                                    // Open Edit Modal
                                    $('.edit-btn').click(function() {
                                        let id = $(this).data('id');
                                        let name = $(this).data('name');

                                        $('#editServiceId').val(id);
                                        $('#editServiceName').val(name);
                                        $('#editModal').modal('show');
                                    });

                                    // Save Edited Service
                                    $('#saveEditBtn').click(function() {
                                        let id = $('#editServiceId').val();
                                        let name = $('#editServiceName').val();

                                        $.post('edit_service.php', {
                                            id: id,
                                            name: name
                                        }, function(response) {
                                            if (response.trim() === 'success') {
                                                // Update the text in the table row immediately
                                                $('tr[data-id="' + id + '"] .service-name').text(name);
                                                // Also update the edit button data
                                                $('tr[data-id="' + id + '"] .edit-btn').data('name', name);

                                                $('#editModal').modal('hide');
                                            } else {
                                                alert('Failed to update service.');
                                            }
                                        });
                                    });

                                    // Delete Service
                                    $('.delete-btn').click(function() {
                                        if (!confirm('Are you sure you want to delete this service?')) return;

                                        let id = $(this).data('id');
                                        $.post('delete_service.php', {
                                            id: id
                                        }, function(response) {
                                            if (response.trim() === 'success') {
                                                $('tr[data-id="' + id + '"]').remove();
                                                updateSerialNumbers();
                                            } else {
                                                alert('Failed to delete service.');
                                            }
                                        }).fail(function(xhr) {
                                            alert("Error: " + xhr.responseText);
                                        });
                                    });

                                    // Update Serial Numbers
                                    function updateSerialNumbers() {
                                        $('#servicesTable tr').each(function(index) {
                                            $(this).find('.serial-number').text(index + 1);
                                        });
                                    }
                                });
                            </script>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</div>

<?php include 'end.php'; ?>