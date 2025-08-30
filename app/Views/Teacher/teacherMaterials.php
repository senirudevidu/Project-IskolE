    <!--Nav4 : Materials-->
    <section class="material-entry tab-panel">
      <div class="heading">
        <h1 class="first-heading">Upload Teaching Materials</h1>
        <p class="first-description">
          Share lesson plans and worksheets with students
        </p>
      </div>

      <div class="upload-section">
        <form
          action="../../Controllers/materialController.php"
          method="post"
          enctype="multipart/form-data"
        >
          <div class="form-filter-tabs">
            <div class="grade-tab">
              <label for="grade" class="tab-label">Select Grade:</label>
              <select name="grade" id="Grade" class="tab-select" required>
                <option value="null"></option>
                <option value="06" class="mark-tabs-option">06</option>
                <option value="07" class="mark-tabs-option">07</option>
                <option value="08" class="mark-tabs-option">08</option>
                <option value="09" class="mark-tabs-option">09</option>
              </select>
            </div>

            <div class="class-tab">
              <label for="class" class="tab-label">Select Class:</label>
              <select name="class" id="Grade" class="tab-select" required>
                <option value="null"></option>
                <option value="A">A</option>
                <option value="B">B</option>
              </select>
            </div>

            <div class="subject-tab">
              <label for="subject" class="tab-label">Select subject:</label>
              <select name="subject" id="subject" class="tab-select" required>
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

          <div class="uploadform-elements">
            <label for="material-title" class="material-label"
              >Material Title:</label
            >
            <input
              type="text"
              id="material-title"
              name="material-title"
              class="material-input"
              placeholder="Enter title"
              required
            />

            <label for="material-description" class="material-label"
              >Description:</label
            >
            <textarea
              id="material-description"
              name="material-description"
              class="material-textarea"
              placeholder="Write a brief description..."
              rows="4"
              required
            ></textarea>

            <label for="file-upload" class="material-label">Upload File:</label>
            <input
              type="file"
              id="file-upload"
              name="file-upload"
              class="material-file-input"
            />
          </div>

          <div class="submit-btn">
            <button type="submit" name="submit" class="publish-material-btn">
              Publish Material
            </button>
          </div>
        </form>
      </div>

      <div class="material-list">
        <div class="heading">
          <h1 class="first-heading">Uploaded Materials</h1>
          <p class="first-description">Materials uploaded by you</p>
        </div>

        <div class="material-list">
          <div class="material-item">
            <div class="material-item-container1">
              <h2 class="material-title">Material Title</h2>
              <p class="material-content">
                This is the content of the material. It contains important
                information for students and parents.
              </p>
            </div>

            <div class="material-item-right">
              <p class="material-date">Date: 2023-10-01</p>
              <button class="remove-btn">Remove</button>
            </div>
          </div>

          <div class="material-item">
            <div class="material-item-container1">
              <h2 class="material-title">Material Title</h2>
              <p class="material-content">
                This is the content of the material. It contains important
                information for students and parents.
              </p>
            </div>

            <div class="material-item-right">
              <p class="material-date">Date: 2023-10-01</p>
              <button class="remove-btn">Remove</button>
            </div>
          </div>
        </div>
      </div>
    </section>