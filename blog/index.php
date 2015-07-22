<?php
  // connect
  require_once('DB.php');
  $db = DB::connect("mysql://root:password@localhost/blog");
  if (DB::iserror($db)) {
    die($db->getMessage());
  }

  // query
  $sql = "SELECT * FROM articles ORDER BY articles.createDate DESC";
  $q = $db->query($sql);
  if (DB::iserror($db)) {
    die($q->getMessage());
  }

  // generate
  $data = array();
  while ($q->fetchInto($row)) {
    if (DB::isError($success)) {
      die($success->getMessage());
    }
    var $tmp = array();
    $tmp['href'] = "article.php?id=" . $row['id'];
    $tmp['title'] = $row['title'];
    $tmp['author'] = $row['author'];
    $tmp['date'] = substr($row['createTime'], 0, 10);
    $data[] = $tmp;
  }
?>
<!-- index.html -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Hello React</title>
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
            <h2>Miki 和 她的饲养员</h2>
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

      var ArticleItem = React.createClass({
        render: function() {
          var liStyle = {
            'list-style-type': 'none',
            display: 'inline-block',
            width: '600px',
          },
          aStyle = {
            display: 'inline-block',
            width: '400px',
          },
          spanStyle = {
            display: 'inline-block',
            width: '100px',
            color: '#777',
          };
          var data = this.props.data;
          return (
            <li style={liStyle}>
              <a style={aStyle} href={data.href}>{data.title}</a>
              <span style={spanStyle}>{data.author}</span>
              <span style={spanStyle}>{data.date}</span>
            </li>
          );
        }
      });

      var ArticleList = React.createClass({
        render: function() {
          var articleItems = this.props.data.map(function(article) {
            return (
              <ArticleItem data={article} />
            );
          });
          return (
            <div>
              {articleItems}
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
              <ArticleList data={data} />
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