<!-- index.html -->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Hello React</title>
    <script src="../assets/js/react.min.js"></script>
    <script src="../assets/js/JSXTransformer.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/marked.min.js"></script>
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
          var data = {
              title: "This is an article",
              author: "Miki",
              date: "2015-07-32",
              content: "This is *another* comment",
          };
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