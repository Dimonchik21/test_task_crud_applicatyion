<div class="container">
        <h1>
        <?=$title?>
    </h1>
    <br>
    <div class="form-group">
        <h2>List menu item</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">URL</th>
                <th scope="col">LEVEL</th>
                <th scope="col">PARENT</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($menu as $value) :?>
                <tr>
                    <th scope="row">
                        <?=$value['id']?>
                    </th>
                    <td>
                        <?=$value['name']?>
                    </td>
                    <td>
                        <?=$value['url']?>
                    </td>
                    <td>
                        <?=$value['level']?>
                    </td>
                    <td>
                        <?=$value['parent']?>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>