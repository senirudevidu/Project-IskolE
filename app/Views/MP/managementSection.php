<div class="bottem " id="management">
    <div class="box">
        <div class="container info-box-medium" id="add-new-user">
            <div class="heading-section">
                <span class="heading-text">Add New User</span>
                <span class="sub-heading-text">Create new student, teacher or staff account</span>
            </div>
            <div class="content">
                <form action="../../Controllers/addNewUser/addNewUser.php" method="post">
                    <div class="info-box content">
                        <div class="row">
                            <div class="text-field">
                                <span class="heading">First Name</span>
                                <input type="text" placeholder="First Name" title="Enter first name" class="select-box"
                                    id="fName" name='fName' />
                            </div>
                            <div class="text-field">
                                <span class="heading">Last Name</span>
                                <input type="text" placeholder="Last Name" title="Enter last name" class="select-box"
                                    id="lName" name='lName' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-field">
                                <span class="heading">Email</span>
                                <input type="email" placeholder="Email" title="Enter email" class="select-box"
                                    id="email" name='email' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-field">
                                <span class="heading">Phone</span>
                                <input type="tel" placeholder="Phone number" title="Enter phone number(07xxxxxxxx)"
                                    class="select-box" id="phone" name='phone' />
                            </div>
                            <div class="text-field">
                                <span class="heading">Date of birth</span>
                                <input type="date" placeholder="Date of birth" title="Enter date of birth"
                                    class="select-box" id="dob" name='dateOfBirth' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-field">
                                <span class="heading">Address</span>
                                <input type="text" placeholder="address line 1" title="Enter address line 1"
                                    class="select-box" id="addressL1" name='addressLine1' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-field">
                                <input type="text" placeholder="address line 2" title="Enter address line 2"
                                    class="select-box" id="addressL2" name='addressLine2' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-field">
                                <input type="text" placeholder="address line 3" title="Enter address line 3"
                                    class="select-box" id="addressL3" name='addressLine3' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-field">
                                <span class="heading">Gender</span>
                                <select name="gender" id="gender" class="select-box">
                                    <option value="" selected disabled>Gender</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>

                            <div class="text-field">
                                <span class="heading">User Type</span>
                                <select name="role" id="userType" class="select-box">
                                    <option value="" selected disabled>Select User type</option>
                                    <option value="mp">Management</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="student">Student</option>
                                    <option value="parent">Parent</option>
                                </select>
                            </div>
                        </div>
                        <!-- this not for student -->
                        <div class="row new-user-mp new-user-teacher new-user-parent user">
                            <div class="text-field">
                                <span class="heading">NIC number</span>
                                <input type="text" placeholder="NIC number" title="Enter NIC number(xxxxxxxxxxxx)"
                                    class="select-box" id="nic" name="nic" />
                            </div>
                        </div>
                        <!-- this is for students and teachers -->
                        <div class="row new-user-teacher new-user-student user">
                            <div class="text-field">
                                <span class="heading">Grade</span>
                                <input type="number" class="select-box" placeholder="Grade" id="grade" name="grade" />
                            </div>
                            <div class="text-field">
                                <span class="heading">Class</span>
                                <select name="class" id="class" class="select-box">
                                    <option value="" selected disabled>Select Class</option>
                                    <option value="1">A</option>
                                    <option value="2">B</option>
                                </select>
                            </div>
                        </div>

                        <!-- this is for teacher -->
                        <div class="row new-user-teacher user">
                            <div class="text-field">
                                <span class="heading">Subject</span>
                                <select name="subject" id="subject" class="select-box" name="subject">
                                    <option value="" selected disabled>Select subject</option>
                                    <option value="null"></option>
                                    <option value="1">Maths</option>
                                    <option value="2">Science</option>
                                    <option value="3">English</option>
                                    <option value="4">History</option>
                                    <option value="5">Geography</option>
                                    <option value="6">Aesthetics</option>
                                    <option value="7">PTS</option>
                                    <option value="8">Religion</option>
                                    <option value="9">Health and Physical Education</option>
                                    <option value="10">Tamil</option>
                                    <option value="11">Citizenship Education</option>
                                    <option value="12">Sinhala</option>
                                </select>
                            </div>
                        </div>

                        <!-- this is for Parent-->
                        <div class="row new-user-parent user">
                            <div class="text-field">
                                <span class="heading">Student index</span>
                                <input type="number" placeholder="Student index" class="select-box" id="studentIndex"
                                    name="studentIndex" />
                            </div>
                            <div class="text-field">
                                <span class="heading">Relationship type</span>
                                <select type="number" class="select-box" id="relationship" name="relationship">
                                    <option value="" selected disabled>
                                        Select Relationship
                                    </option>
                                    <option value="father">Father</option>
                                    <option value="mother">Mother</option>
                                    <option value="gardian">Gardian</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="text-field">
                                <span class="info-line-item">
                                    <button class="btn btn-blue" id="add-new-user-submit-btn" type="submit"
                                        name="submitUser">
                                        Add New User
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container info-box-medium">
            <div class="heading-section">
                <span class="heading-text">Recent Users</span>
                <span class="sub-heading-text">Recently added users</span>
            </div>
            <div class="content">
                <div class="info-box-content border-container">
                    <div class="left">
                        <span class="info-box-heading-text">M M Thasiya</span>
                        <span class="info-box-sub-heding-text">Student - nov 10</span>
                    </div>
                    <div class="right">
                        <span class="info-box-sub-heding-text" style="color:blue">thasidu@gmail.com</span>
                        <span class="info-box-sub-heding-text" style="color:blue">0714594766</span>
                        <span class="info-box-sub-heding-text">2010-nov-10</span>
                    </div>
                </div>
                <div class="info-box-content border-container">
                    <div class="left">
                        <span class="info-box-heading-text">M M Thasiya</span>
                        <span class="info-box-sub-heding-text">Student - nov 10</span>
                    </div>
                    <div class="right">
                        <span class="info-box-sub-heding-text" style="color:blue">thasidu@gmail.com</span>
                        <span class="info-box-sub-heding-text" style="color:blue">0714594766</span>
                        <span class="info-box-sub-heding-text">2010-nov-10</span>
                    </div>
                </div>
                <div class="info-box-content border-container">
                    <div class="left">
                        <span class="info-box-heading-text">M M Thasiya</span>
                        <span class="info-box-sub-heding-text">Student - nov 10</span>
                    </div>
                    <div class="right">
                        <span class="info-box-sub-heding-text" style="color:blue">thasidu@gmail.com</span>
                        <span class="info-box-sub-heding-text" style="color:blue">0714594766</span>
                        <span class="info-box-sub-heding-text">2010-nov-10</span>
                    </div>
                </div>
                <div class="info-box-content border-container">
                    <div class="left">
                        <span class="info-box-heading-text">M M Thasiya</span>
                        <span class="info-box-sub-heding-text">Student - nov 10</span>
                    </div>
                    <div class="right">
                        <span class="info-box-sub-heding-text" style="color:blue">thasidu@gmail.com</span>
                        <span class="info-box-sub-heding-text" style="color:blue">0714594766</span>
                        <span class="info-box-sub-heding-text">2010-nov-10</span>
                    </div>
                </div>
                <div class="info-box-content border-container">
                    <div class="left">
                        <span class="info-box-heading-text">M M Thasiya</span>
                        <span class="info-box-sub-heding-text">Student - nov 10</span>
                    </div>
                    <div class="right">
                        <span class="info-box-sub-heding-text" style="color:blue">thasidu@gmail.com</span>
                        <span class="info-box-sub-heding-text" style="color:blue">0714594766</span>
                        <span class="info-box-sub-heding-text">2010-nov-10</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="container info-box-large">
            <div class="heading-section">
                <span class="heading-text">User Directory</span>
                <span class="sub-heading-text">Manage all system users</span>
            </div>
            <div class="content">
                <div class="row">
                    <form id="user-search-form" class="row" style="width: 100%">
                        <div class="text-field left">
                            <input type="text" id="user-search-input" name="q" placeholder="Search users ..."
                                class="select-box" value="" />
                        </div>
                        <div class="text-field" style="flex: 0.1">
                            <button class="btn" type="submit">Search</button><br />
                        </div>
                    </form>
                </div>
                <table class="table">
                    <tr class="table-row">
                        <th class="table-head">Name</th>
                        <th class="table-head">Type</th>
                        <th class="table-head">Email</th>
                        <th class="table-head row">
                            <div class="row">
                                Actions
                            </div>
                        </th>
                    </tr>
                    <tbody id="user-table-body">
                        <?php
                        // Server-side fallback: show 5 users when JS is disabled
                        require_once __DIR__ . '/../../Controllers/addNewUser/viewUser.php';
                        $viewSvc = new ViewUser();
                        $fallbackUsers = $viewSvc->viewRecentUsers(5);
                        if (empty($fallbackUsers)) {
                            echo "<tr class='table-row'><td class='table-data' colspan='4'>No users found.</td></tr>";
                        } else {
                            foreach ($fallbackUsers as $user) {
                                $uid = (int) $user['userID'];
                                $name = htmlspecialchars($user['fName'] . ' ' . $user['lName']);
                                $role = htmlspecialchars($user['role']);
                                $email = htmlspecialchars($user['email']);
                                echo "<tr class='table-row' data-user-id='{$uid}'>
                                <td class='table-data'>{$name}</td>
                                <td class='table-data'>{$role}</td>
                                <td class='table-data'>{$email}</td>
                                <td class='table-data'>
                                    <div class='row'>
                                        <button class='btn edit-user-btn' data-user-id='{$uid}'>Edit</button>
                                        <button class='btn btn-red' data-user-id='{$uid}'>Delete</button>
                                    </div>
                                </td>
                            </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="edit-user-modal" class="modal hidden" aria-hidden="true" role="dialog" aria-labelledby="edit-user-title">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="edit-user-title">Edit User</h3>
            </div>
            <form id="edit-user-form">
                <input type="hidden" name="userID" id="edit-userID" />
                <div class="row">
                    <div class="text-field">
                        <span class="heading">First Name</span>
                        <input type="text" class="select-box" id="edit-fName" name="fName" required />
                    </div>
                    <div class="text-field">
                        <span class="heading">Last Name</span>
                        <input type="text" class="select-box" id="edit-lName" name="lName" required />
                    </div>
                </div>
                <div class="row">
                    <div class="text-field">
                        <span class="heading">Email</span>
                        <input type="email" class="select-box" id="edit-email" name="email" required />
                    </div>
                    <div class="text-field">
                        <span class="heading">Phone</span>
                        <input type="tel" class="select-box" id="edit-phone" name="phone" />
                    </div>
                </div>
                <div class="row">
                    <div class="text-field">
                        <span class="heading">Date of birth</span>
                        <input type="date" class="select-box" id="edit-dob" name="dateOfBirth" />
                    </div>
                    <div class="text-field">
                        <span class="heading">Gender</span>
                        <select name="gender" id="edit-gender" class="select-box">
                            <option value="">Select Gender</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="justify-content: flex-end; gap: 8px; margin-top: 16px;">
                    <button type="button" class="btn" id="edit-user-cancel">Cancel</button>
                    <button type="submit" class="btn btn-blue" id="edit-user-save">Save Changes</button>
                </div>
            </form>
        </div>
        <style>
            .modal.hidden {
                display: none;
            }

            .modal {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.4);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 1000;
            }

            .modal-content {
                background: #fff;
                width: min(700px, 95vw);
                border-radius: 8px;
                padding: 16px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            }

            .modal-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 12px;
            }

            .modal-close {
                border: none;
                background: transparent;
                font-size: 22px;
                cursor: pointer;
            }
        </style>
    </div>
</div>