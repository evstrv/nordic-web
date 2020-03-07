<?php
    include 'header.php';
?>

<?php
    $link = mysqli_connect('localhost', 'root', '', 'web0812');
    mysqli_set_charset($link, 'utf-8');

    var_dump($_GET);

    if (!empty($_GET) && !empty($_GET['del'])) {

        // $query = "DELETE FROM feedbacks WHERE ";

        // foreach ($_GET['del'] as $id=>$item) {
        //     $query .= "ID=$item";

        //     if ($id !== count($_GET['del']) - 1) {
        //         $query .= " OR ";
        //     }
        // }

        // var_dump($query);

        $query = "UPDATE feedbacks SET MESSAGE='Пусто' WHERE ID IN(" . implode(',', $_GET['del']) . ")";
        // $query = "DELETE FROM feedbacks WHERE ID IN(" . implode(',', $_GET['del']) . ")";
        $res = mysqli_query($link, $query);

        if (!$res) {
            var_dump(mysqli_error($link));
        }
    }

    $query = "SELECT * FROM feedbacks";
    $res = mysqli_query($link, $query);

    $feedbacks = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $feedbacks [] = $row;
    }

    $heads = array_keys($feedbacks[0]);

    echo '<pre>';
    var_dump($feedbacks);
    echo '</pre>';

    mysqli_close($link);
?>
<div class="feedbacks">
    <h1>Заявки</h1>
    <form method="get" action="">
        <table> 
            <thead>
                <tr>
                    <?php foreach($heads as $head):?>
                        <th><?=$head?></th>
                    <?php endforeach;?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($feedbacks as $id=>$row):?>
                    <tr>
                        <?php foreach($row as $key=>$cell):?>
                            <td>
                                <?php if($key === 'ID'):?>
                                    <input type="checkbox" value="<?=$cell?>" id="<?="row_$id"?>" name="del[]">
                                <?php endif;?>
                                <label for="<?="row_$id"?>">
                                    <?php if ($key === 'FIO'):?>
                                        <input type="text" name="name" value="<?=$cell?>">
                                    <?php else:?>
                                        <?=$cell?>
                                    <?php endif;?>
                                </label>
                            </td>
                        <?php endforeach;?>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <input type="submit" value="Удалить/Обновить">
    </form>
</div>

<?php
    include 'footer.php';
?>