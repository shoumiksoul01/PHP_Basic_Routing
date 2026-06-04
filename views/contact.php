<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
</head>
<body>

<h1>Contact Us</h1>

<nav>
    <a href="/">Home</a> |
    <a href="/about">About</a> |
    <a href="/contact">Contact</a>
</nav>

<?php if (!empty($_GET['success'])): ?>
    <p style="color:green;">
        Message sent successfully.
    </p>
<?php endif; ?>

<?php if (!empty($errors)): ?>

    <div style="color:red;">
        <ul>

            <?php foreach ($errors as $error): ?>

                <li><?= htmlspecialchars($error) ?></li>

            <?php endforeach; ?>

        </ul>
    </div>

<?php endif; ?>

<form method="POST" action="/contact">

    <div>
        <label>Name</label><br>
        <input
            type="text"
            name="name"
            value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
        >
    </div>

    <br>

    <div>
        <label>Email</label><br>
        <input
            type="email"
            name="email"
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
        >
    </div>

    <br>

    <div>
        <label>Message</label><br>
        <textarea name="message" rows="5" cols="40"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
    </div>

    <br>

    <button type="submit">
        Send Message
    </button>

</form>

</body>
</html>