<html>
    <head>
        <meta charset="UTF-8">
        <title>Questions</title>
    </head>
    <body>
    <?php include_once 'logged_in_header.php'; ?>
        <a href="<?= url("category.php?id={$_GET['category_id']}"); ?>">Back to questions in this category</a>
        <form method="POST">
            Title <input type="text" name="title"/>
            Question: <br/>
            <textarea rows="5" cols="30" name="body"></textarea>
            Category:
            <select name="category">
                <?php foreach ($categories as $category): ?>
                    <option <?= $category['id'] == $categoryId ? 'selected' : ''?> value="<?= $category['id'] ?> (<?= $category['questions_count'] ?>)"><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <br/><br/>
            Tags: <br/>
            <select multiple="multiple" name="existing_tags[]">
                <?php foreach ($tags as $tag): ?>
                    <option value="<?= $tag['id'] ?> (<?= $tag['questions_count'] ?>)"><?= $tag['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <br/>
            Add tags: <input type="text" name="new_tags" placeholder="Enter your tags separeted by comma..."/>
            <input type="submit" value="Ask">
        </form>
    </body>
</html>
