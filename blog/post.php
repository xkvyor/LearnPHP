<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>发布文章</title>
    <script src="../assets/js/react.min.js"></script>
    <script src="../assets/js/JSXTransformer.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/marked.min.js"></script>
    <script src="../assets/js/highlight.pack.js"></script>
    <script src="../assets/js/page.js"></script>
    <link rel="stylesheet" href="../assets/css/monokai_sublime.min.css">
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
              <a style={aStyle} href="post.php">新的文章</a>
            </div>
          );
        }
      });

      var TitleInput = React.createClass({
        render: function() {
          var style = {
            width: "469px",
            "font-size": "14px",
            "line-height": "18px",
            padding: "5px"
          };
          return (
            <div>
              <input type="text" name="title" style={style} />
            </div>
          );
        }
      });

      var AuthorInput = React.createClass({
        render: function() {
          var style = {
            width: "469px",
            "font-size": "14px",
            "line-height": "18px",
            padding: "5px"
          };
          return (
            <div>
              <input type="text" name="author" style={style} />
            </div>
          );
        }
      });

      var TextInput = React.createClass({
        render: function() {
          var divStyle = {
            width: "50%",
            "float": "left"
          },
          textStyle = {
            resize: "none",
            width: "90%",
            height: "270px",
            "line-height": "18px",
            "font-size": "14px",
            padding: "15px"
          };
          return (
            <div style={divStyle}>
              <textarea id="text_input" name="content" style={textStyle} rows="6"></textarea>
            </div>
          );
        }
      });

      var Preview = React.createClass({
        render: function() {
          var style = {
            width: "50%",
            height: "300px",
            "float": "left",
            overflow: "auto"
          };
          return (
            <div style={style}>
              <div id="pre"></div>
            </div>
          );
        }
      });

      var Post = React.createClass({
        render: function() {
          var style = {
            margin: "20px 0"
          };
          return (
            <div style={style}>
              <input type="submit" value="发表" />
            </div>
          );
        }
      });

      var Editor = React.createClass({
        render: function() {
          var style = {
            width: "1000px",
            margin: "20px 0 0 0"
          },
          clear = {
            clear: "both"
          },
          subStyle = {
            margin: "10px 0"
          };
          return (
            <div style={style}>
              <form action="submit.php" method="post">
                <div style={subStyle}>题目：</div>
                <TitleInput />
                <div style={subStyle}>作者：</div>
                <AuthorInput />
                <div style={subStyle}>内容：</div>
                <TextInput />
                <Preview />
                <div style={clear}></div>
                <Post />
              </form>
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
              <Editor />
            </div>
          );
        }
      });

      React.render(
        React.createElement(Container, null),
        document.getElementById('content')
      );

      $("#text_input").on("input", function() {
        var str = $("#text_input").val();
        $("#pre").html(marked(str));
      });
    </script>
  </body>
</html>
