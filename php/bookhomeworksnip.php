<!-- New Test Offcanvas -->

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvastest" aria-labelledby="testoffcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-primary" id="testoffcanvas">Book New Homework</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="py-2 mx-4 my-3 text-danger border border-danger rounded text-center fw-bold d-none" id="errorbox">This is error message....</div>
        <form action="#" method="post" id="bookhomeworkform">
            <div class="mb-3">
                <label for="testtitle" class="form-label">Subject:</label>
                <input type="text" class="form-control" id="testtitle" placeholder="Math/English/..." name="subject">
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Homework description:</label>
              <textarea class="form-control" name="description" id="description" placeholder="You have to....." rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="selectday" class="form-label">Day:</label>
                <select class="form-select form-select-lg" name="day" id="selectday">
                    <option selected value="0">DD</option>
                    <?php 
                        for($i = 1; $i <= 31; $i++){
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="selectmonth" class="form-label">Month:</label>
                <select class="form-select form-select-lg" name="month" id="selectmonth">
                    <option selected value="0">MM</option>
                    <?php 
                        for($i = 1; $i <= 12; $i++){
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="selectyear" class="form-label">Year:</label>
                <select class="form-select form-select-lg" name="year" id="selectyear">
                    <option selected value="0">YYYY</option>
                    <?php 
                        $year = date("Y");
                        for($i = $year; $i <= $year + 5; $i++){
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                    ?>
                </select>
            </div>
            <input name="classid" value="<?php echo $_GET['c'] ?>" hidden>
            <button type="submit" class="btn btn-primary float-end" id="bookhomeworkbutton">Submit</button>                    
        </form>
    </div>
</div>