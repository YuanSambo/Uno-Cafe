<?php include("header.php") ?>

<!----------Contact us------>

<div class=" container-fluid contact">
    <div class="contact-title">
        <h2>Welcome!</h2>
        <h2>How we can help you?</h2>
    </div>
    <div class="contact-form">
        <form id="contact-form" method="post" action="">
            <input name="name" type="text" class="form" placeholder="Your Name" required />
            <br />
            <input name="email" type="email" class="form" placeholder="Your Email" required />
            <br />
            <textarea id="message" name="message" class="form" placeholder="Write something.." rows="4"></textarea>
            <br />

            <input type="submit" class="form-submit" value="SEND MESSAGE" />
        </form>
    </div>
</div>

<?php include("footer.php") ?>