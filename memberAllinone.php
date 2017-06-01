<?php
include 'sql.php';
$pdo = new pdo($dsn, $user, $passwd, $opt);
// Add
if (isset($_GET['add'])) {
    $account  = $_GET['account'];
    $passwd   = $_GET['passwd'];
    $realname = $_GET['realname'];
    $sql = "insert into member (account,passwd,realname) values (?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$account,$passwd,$realname]);
}
// Delete
if (@isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $sql = "delete from member where id = ?";
    $stmt = $pdo->prepare($sql);
    var_dump($stmt);
    $stmt->execute([$delid]);
}
// Edit
if (@isset($_GET['editid'])) {
    $editid = $_GET['editid'];
    $stmt = $pdo->prepare('select * from member where id = ?');
    $stmt->execute([$editid]);
    $editObj = $stmt->fetchObject();
} else {
    class edit {
        var $id;
        var $account;
        var $passwd;
        var $realname;
    }
    $editObj = new edit();
    $editObj->id       = ' ';
    $editObj->account  = ' ';
    $editObj->passwd   = ' ';
    $editObj->realname = ' ';
}
if (isset($_GET['update'])) {
    $id       = $_GET['id'];
    $account  = $_GET['account'];
    $passwd   = $_GET['passwd'];
    $realname = $_GET['realname'];
    $sql = "update member set account=?,passwd=?,realname=? where id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$account,$passwd,$realname,$id]);
}
// Query
$stmt = $pdo->prepare('select * from member');
$stmt->execute();

?>
<form>
<table style="float:left; margin:10px; padding:20px;">
    <tr>
        <td>ID:<input type="text" name="id" readonly
                   value="<?php echo $editObj->id; ?>"></td>
        <td>Account:<input type="text" name="account"
                   value="<?php echo $editObj->account; ?>"></td>
        <td>Password:<input type="text" name="passwd"
                   value="<?php echo $editObj->passwd; ?>"></td>
        <td>Real Name:<input type="text" name="realname"
                   value="<?php echo $editObj->realname; ?>"></td>
        <td>
            <?php
            if (@isset($_GET['editid'])) {
                echo '<input type="submit" name="update" value="Update">';
            } else {
                echo '<input type="submit" name="add" value="Insert">';
            }
            ?>
        </td>
    </tr>
</table>

<table border="1" width="100%">
    <tr>
        <th>Edit</th>
        <th>ID</th>
        <th>Account</th>
        <th>Password</th>
        <th>Real Name</th>
        <th>Delete</th>
    </tr>
    <?php
    while ($row = $stmt->fetchObject()) {
        echo "<tr>";
        echo "<td><a href='?editid={$row->id}'>Edit</td>";
        echo "<td>{$row->id}</td>";
        echo "<td>{$row->account}</td>";
        echo "<td>{$row->passwd}</td>";
        echo "<td>{$row->realname}</td>";
        echo "<td><a href='?delid={$row->id}'>Delete</td>";
        echo "</tr>";
    }
    ?>
</table>
</form>