<?php
  if (!$_POST["title"] || !$_POST["author"] || !$_POST["content"])
  {
    header('Location: ' . "index.php", true, 303);
    die();
  }

  $title = $_POST["title"];
  $author = $_POST["author"];
  $content = $_POST["content"];

  $filepath = "articles/" . hash('ripemd160', $content);
  $f = fopen($filepath, "w") or die("Unable to open file!");
  fwrite($f, $content);
  fclose($f);

  // connect
  $server = "localhost";
  $username = "blog";
  $password = "password";
  $dbname = "blog";
  $conn = new mysqli($server, $username, $password, $dbname);
  if (!$conn) {
    die("Connect database failed: " . mysql_connect_error());
  }

  // query
  $sql = "INSERT INTO articles (title, author, posttime, path) values (
          $title, $author, NOW(), $path
          )";
  $result = $conn->query($sql);

  // generate
  $data = array();
  while ($row = $result->fetch_assoc()) {
    $tmp = array();
    $tmp['href'] = "article.php?id=" . $row['id'];
    $tmp['title'] = $row['title'];
    $tmp['author'] = $row['author'];
    $tmp['date'] = substr($row['posttime'], 0, 10);
    $data[] = $tmp;
  }

  // close
  $conn->close();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>发布成功</title>
    <script src="../assets/js/react.min.js"></script>
    <script src="../assets/js/JSXTransformer.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
  </head>
  <body>
    <div id="content"></div>
    <script type="text/jsx">
      var Title = React.createClass({
        render: function() {
          return (
            <h1>Miki 和 她的饲养员</h1>
          );
        }
      });

      var Menu = React.createClass({
        render: function() {
          var menuStyle = {
            margin: '0 0 10px 0',
          },
          aStyle = {
            'text-decoration': 'none',
            'decoration': 'none',
            color: 'blue',
            display: 'inline-block',
            width: '100px',
          };
          return (
            <div style={menuStyle}>
              <a style={aStyle} href="index.php">文章列表</a>
              <a style={aStyle} href="index.php">新的文章</a>
            </div>
          );
        }
      });

      var Container = React.createClass({
        render: function() {
          var style = {
            width: '1000px',
            margin: 'auto',
          };
          return (
            <div style={style}>
              <Title />
              <Menu />
              <div>
                <p>发布成功</p>
              </div>
            </div>
          );
        }
      });

      React.render(
        React.createElement(Container, null),
        document.getElementById('content')
      );
    </script>
  </body>
</html>