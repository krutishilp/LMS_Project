<div id="Act2" class="desc1">
    <h3>Seminar Notice</h3>
    <form action='#' method='POST' enctype='multipart/form-data'>
        <label for="seminar_title">Seminar Title</label>
        <input type="text" id="seminar_title" name="seminar_title" required><br><br>
        <label for="file_seminar">Notice</label><br>
        <input type="file" id="file_seminar" name="file" required><br><br>
        <label for="seminar_date">Seminar Date: </label>
        <input type="date" id="seminar_date" name="seminar_date" placeholder="Seminar Date" style="width: 75%;" required><br><br>
        <input type='submit' value='Post' name='postSeminar'><br>
    </form>
</div>
<div id="Act3" class="desc1" style="display: none;">
    <h3>Feedback Form</h3>
    <form action='#' method='POST' enctype='multipart/form-data'>
        <label for="feedback_title">Feedback form Title</label>
        <input type="text" id="feedback_title" name="feedback_title" required><br><br>
        <label for="feedback_link">Feedback form Link</label>
        <input type="text" id="feedback_link" name="feedback_link" required><br><br>
        <label for="feedback_date">Form Deadline: </label>
        <input type="date" id="feedback_date" name="feedback_date" placeholder="feedback Date" style="width: 75%;" required><br><br>
        <input type='submit' value='Post' name='postFeedback'><br>
    </form>
</div>

<?php

if (isset($_POST['postSeminar'])) {
    $dir = "../seminar/";
    $title = $_POST['seminar_title'];
    $filename = $_POST['file']['name'];
    $sdate = $_POST['seminar_date'];
    $target_file = $dir . $_FILES['file']['name'];
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        $insertSem = "INSERT INTO seminar(title,notice,seminar_date) VALUES('$title','$target_file','$sdate')";
        if ($run = mysqli_query($conn, $insertSem)) {
            echo '<script type="text/javascript">alert("Done")</script>';
        }
    }
}
if (isset($_POST['postFeedback'])) {
    $title = $_POST['feedback_title'];
    $link = $_POST['feedback_link'];
    $fdate = $_POST['feedback_date'];
    $insertfeed = "INSERT INTO feedback(title,link,feedback_date) VALUES('$title','$link','$fdate')";
    if ($run = mysqli_query($conn, $insertfeed)) {
        echo '<script type="text/javascript">alert("Done")</script>';
    }
} else {
    echo mysqli_error($conn);
}

?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $("input[name$='act']").click(function() {
            var t = $(this).val();
            $("div.desc1").hide();

            $("#Act" + t).show();

            //    $("#quiz" + test).css("display","block");
        });
    });
</script>