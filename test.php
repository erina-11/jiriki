<?php include('header.php'); ?>

</header>

<main>

    <form action="test_act.php" method="post">
        <div class="form-group">
            <label for="formGroupExampleInput">id</label>
            <input type="text" name="id" class="form-control">

            <label for="formGroupExampleInput">nickname</label>
            <input type="text" name="nickname" class="form-control">

            <label for="formGroupExampleInput">profeil</label>
            <input type="text" name="profeil" class="form-control">

            <label for="formGroupExampleInput">password</label>
            <input type="text" name="password" class="form-control">

            <input type="submit">

        </div>

    </form>

</main>

<?php include('footer.php'); ?>