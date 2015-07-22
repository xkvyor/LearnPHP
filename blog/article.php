<?php
  if (!$_GET["id"] || ($id = (int)$_GET["id"]) <= 0)
  {
    header('Location: ' . "index.php", true, 303);
    die();
  }

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
  $sql = "SELECT * FROM articles WHERE articles.id = $id";
  $result = $conn->query($sql);

  // generate
  $row = $result->fetch_assoc();
  $data = array();
  $data['title'] = $row['title'];
  $data['author'] = $row['author'];
  $data['date'] = substr($row['posttime'], 0, 10);
  $filepath = $row['path'];
  $f = fopen($filepath, "r") or die("Unable to open file!");
  $data['content'] = fread($f, filesize($filepath));
  fclose($f);

  // close
  $conn->close();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title><?php echo $data['title'] ?></title>
    <script src="../assets/js/react.min.js"></script>
    <script src="../assets/js/JSXTransformer.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/marked.min.js"></script>
    <script src="../assets/js/highlight.pack.js"></script>
    <script src="../assets/js/post.js"></script>
    <link rel="stylesheet" href="../assets/css/GitHub2.css">
    <link rel="stylesheet" href="../assets/css/monokai_sublime.css">
  </head>
  <body>
    <div id="content"></div>
    <script type="text/jsx">
      var Title = React.createClass({
        render: function() {
          return (
            <h1>没想好名字</h1>
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
              <a style={aStyle} href="post.php">新的文章</a>
            </div>
          );
        }
      });

      var Article = React.createClass({
        render: function() {
          var spanStyle = {
            color: '#777',
            'font-size': '14px',
          };
          var data = this.props.data,
            rawMarkup = marked(data.content, {sanitize: true});
          return (
            <div>
              <h2>{data.title}</h2>
              <div>
                <span style={spanStyle}>{data.author} 发表于 {data.date}</span>
              </div>
              <div>
                <span dangerouslySetInnerHTML={{__html: rawMarkup}} />
              </div>
            </div>
          );
        }
      });

      var Container = React.createClass({
        render: function() {
          var data = <?php echo json_encode($data) ?>;
          var style = {
            width: '1000px',
            margin: 'auto',
          };
          return (
            <div style={style}>
              <Title />
              <Menu />
              <Article data={data} />
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
