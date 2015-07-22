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
      var CommentBox = React.createClass({displayName: 'CommentBox',
        render: function() {
          return (
            React.createElement('div', {className: "commentBox"},
              "Hello, world!"
            )
          );
        }
      });
      React.render(
        React.createElement(CommentBox, null),
        document.getElementById('content')
      );
    </script>
  </body>
</html>