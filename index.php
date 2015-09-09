<html>
	<head>
	<link href="style.css" rel="stylesheet">
	</head>
<h1>Новостной портал</h1>
<?
class DB
{
protected $connection;
public function __construct($dsn, $user, $password)
	{
		$this->connection=new PDO($dsn, $user, $password);
		if( !$this->connection ) {
            throw new Exception('Could not connect to DB ');
        }
	}
public function query($sql){
        if ( !$this->connection ){
            return false;
        }

        $result = $this->connection->query($sql);
		return $result;
		}
public function select_all_news()
	{
		$sql='SELECT `id`,`title` FROM news';
		$news = $this->query($sql)->fetchAll();
		return $news;
	}
public function select_each_news()
	{
		$sqt='SELECT * FROM news WHERE `id`='.$_GET['id'].'';
		$each_news = $this->query($sqt)->fetch();
		?><div class="title"><?
		echo "{$each_news['title']} <br/>";?>
		</div><div class="text">
		<?echo $each_news['text'];?>
		</div>
		<?
		
	}
}


$dsn='mysql:dbname=students; host=127.0.0.1';
$user='root';
$pass='';

$dbh= new DB($dsn, $user, $pass);
?>

<?
	if(array_key_exists('id',$_GET))
	{
		?><div class="nav"><?
		echo '<a href="/index.php">Главная</a>->Новость ';
		echo $_GET['id']+1;
		?>
		</div>
		<?
		$new_news=$dbh->select_each_news($a);
	}
	else
	{
?>
	<ul>
<?
	$news=$dbh->select_all_news();
	foreach($news as $id=>$item)
	{
		echo '<li><a href="/index.php?id='.$id.'">'.$item['title'].'</a></li>';
	}
	
?>
	</ul>
<?
	}
?>
</html>

