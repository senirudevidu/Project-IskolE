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
                                <input type="number" placeholder="Phone number" title="Enter phone number(07xxxxxxxx)"
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
                                <input type="number" placeholder="NIC number" title="Enter NIC number(xxxxxxxxxxxx)"
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
                                    <option value="1">Maths</option>
                                    <option value="2">Sinhala</option>
                                    <option value="3">IT</option>
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
            </div>
            ></form>
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
                    <div class="text-field left">
                        <input type="number" placeholder="Search users ..." class="select-box" />
                    </div>
                    <div class="text-field" style="flex: 0.1">
                        <button class="btn">Search</button><br />
                    </div>
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
                    <tr class="table-row">
                        <td class="table-data">Adiya</td>
                        <td class="table-data">Student</td>
                        <td class="table-data">adith@gmail.com</td>
                        <td class="table-data">
                            <div class="row">
                                <button class="btn">Edit</button>
                                <button class="btn btn-red">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-data">Adiya</td>
                        <td class="table-data">Student</td>
                        <td class="table-data">adith@gmail.com</td>
                        <td class="table-data">
                            <div class="row">
                                <button class="btn">Edit</button>
                                <button class="btn btn-red">Delete</button>
                            </div>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-data">Adiya</td>
                        <td class="table-data">Teacher</td>
                        <td class="table-data">adith@gmail.com</td>
                        <td class="table-data">
                            <div class="row">
                                <button class="btn">Edit</button>
                                <button class="btn btn-red">Delete</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>