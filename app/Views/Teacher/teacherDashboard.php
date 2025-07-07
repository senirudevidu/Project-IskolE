<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="/projectIskole/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/projectIskole/">
    <link rel="stylesheet" href="public/css/teacherDashboard.css">
    <title>Document</title>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/projectIskole/app/Views/layouts/sumTab.php"; ?>
    

    <!--Nav1 : Marks Entry-->
    <section class="marks-entry">

        <div class="heading">
            <h1 class="first-heading">Enter Student Marks</h1>
            <p class="first-description">Record marks for recent examination</p>
        </div>

        <div class="markentry-form">
            <form action="#" method="POST">
                <div class="form-filter-tabs">
                    <div class="grade-tab">
                        <label for="grade" class="tab-label">Select Grade:</label>
                        <select name="Grade" id="Grade" class="tab-select">
                            <option value="null"></option>
                            <option value="12" class="mark-tabs-option">12</option>
                            <option value="13" class="mark-tabs-option">13</option>
                        </select>
                    </div>

                    <div class="class-tab">
                        <label for="class" class="tab-label">Select Class:</label>
                        <select name="class" id="Grade" class="tab-select">
                            <option value="null"></option>
                            <option value="12">A</option>
                            <option value="13">B</option>
                            <option value="12">C</option>
                            <option value="13">D</option>
                        </select>
                    </div>

                    <div class="semester-tab">
                        <label for="semester" class="tab-label">Select Semester:</label>
                        <select name="semester" id="semester" class="tab-select">
                            <option value="null"></option>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                            <option value="3">Semester 3</option>
                        </select>
                    </div>

                    <div class="search-btn-container">
                        <button type="submit" class="search-btn">
                            <img src="public\assests\search.png" alt="search icon" height="40px" width="40px">
                        </button>
                    </div>

                </div>
                
            </form>
        </div>


        <div class="marks-table">
            <form action="#">
                <table class="marks-table-content">
                    <thead>
                        <tr>
                            <th class="rollnumber">Roll Number</th>
                            <th class="studentName">Student Name</th>
                            <th class="studentMarks">Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>101</td>
                            <td>John Doe</td>
                            <td class="input-coloumn"><input type="number" name="marks" min="0" max="100" class="marks-input" placeholder="0-100"> / 100</td>
                        </tr>
                        <tr>
                            <td>102</td>
                            <td>Jane Smith</td>
                            <td class="input-coloumn"><input type="number" name="marks" min="0" max="100"class="marks-input" placeholder="0-100"> / 100</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="submit-btn">
                <button type="submit" class="submit-marks-btn">Submit Marks</button>
            </div>

        </form>

    </section>

</body>
</html>