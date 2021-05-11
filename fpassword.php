
<form name="Login_Form" action ="checklogin.php" class="sa-innate-form" method="post">
            <label>Email</label>
            <input type="text" name="Email">
</form>

<script>
document.onkeydown = function(e) {
        if (e.ctrlKey &&
            (e.keyCode === 67 ||
             e.keyCode === 86 ||
             e.keyCode === 85 ||
             e.keyCode === 117)) {
            alert('not allowed');
            return false;
        } else {
            return true;
        }
};
</script>