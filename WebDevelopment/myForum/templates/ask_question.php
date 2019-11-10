<html>
    <head>
        <title>Ask Questions</title>
    </head>

    <body>
        <h1>Ask question</h1>
        <a href="<?= url("category.php?id={$_GET['id']}") ?>">Back to question in this category</a>
        <br/>
        <br/>
        <form method="post">
            Title: <input type="text" name="title"/><br/>
            Question: <br/>
            <textarea rows="5" cols="30" name="body"></textarea><br/>
            Category:
            <select name="category">
                <?php foreach($categories as $category): ?>
                    <option <?= $category['id'] == $categoryId ? 'selected': ''; ?> value="<?= $category['id']?>" ><?= $category['name']?> (<?= $category['questions_count']?>)</option>
                <?php endforeach; ?>
            </select>
            <br/><br/>
            Tags:<br/>
            <select multiple="multiple" name="existing_tags[]">
                <?php foreach($tags as $tag): ?>
                    <option value="<?= $tag['id'] ?>"><?= $tag['name'] ?> <?= $tag['questions_count'] ?></option>
                <?php endforeach; ?>
            </select>
            <br/><br/>
            Add tags: <input type="text" name="tags" placeholder="Enter your tags separated by comma..."/>
            <br/><br/>

            <input type="submit" name="Ask!"/>
        </form>
        <div id="response" style="color: red">
            <?= $response ?? null ?>
        </div>
    </body>
</html>