<div class="container">
    <div class="form-group">
        <h2>Список элементов меню</h2>
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
    <div class="form-group">
        <h2><?=$title?></h2>
        <form action="/menu-delete" method="POST">
            <div class="form-group">
                <label for="id">Name of menu item</label>
                <input type="text" name="id" class="form-control" id="id" placeholder="Укажите id элемента для удаления">
            </div>
            <button type="submit" class="btn btn-primary">Удалить</button>
        </form>
    </div>
</div>
