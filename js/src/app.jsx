var converter = new Showdown.converter();

var Comment = React.createClass({
    render: function () {
        var title = this.props.title ? converter.makeHtml(this.props.title) : '';
        var body = this.props.body ? converter.makeHtml(this.props.body) : '';
        return (
            <div className="comment thumbnail">
                <h2 className="commentAuthor">
                    {this.props.id}
                </h2>
                <span dangerouslySetInnerHTML={{__html:
                    '<i class="fa fa-calendar"></i>&NonBreakingSpace;' + this.props.date + '&nbsp;' + title}}
                />
                <p dangerouslySetInnerHTML={{__html: body}} />
            </div>
        );
    }
});

var CommentList = React.createClass({
    render: function () {
        var commentNodes = this.props.data.map(function (comment) {
            return (
                <Comment id={comment.id} title={comment.title} body={comment.body} date={comment.date} >
                </Comment>
            );
        });
        return (
            <div className="commentList col-md-3">
                {commentNodes}
            </div>
        );
    }
});

var CommentForm = React.createClass({
    handleSubmit: function (e) {
        e.preventDefault();
        var title = this.refs.title.getDOMNode().value.trim();
        if (!title) {
            return;
        }
        // TODO: send request to the server
        this.props.onCommentSubmit({title: title});
        this.refs.title.getDOMNode().value = '';
    },
    render: function () {
        return (
            <form className="commentForm" onSubmit={this.handleSubmit}>
                <input type="text" placeholder="Write something..." ref="title" />
                <input type="submit" value="Note it" />
            </form>
        );
    }
});

var CommentBox = React.createClass({
    loadCommentsFromServer: function () {
        $.ajax({
            url: this.props.url,
            dataType: 'json',
            success: function (data) {
                this.setState({data: data});
            }.bind(this),
            error: function (xhr, status, err) {
                console.error(this.props.url, status, err.toString());
            }.bind(this)
        });
    },
    handleCommentSubmit: function (comment) {
        var comments = this.state.data;
        var newComments = comments.concat([comment]);
        this.setState({data: newComments});
        $.ajax({
            url: this.props.url,
            dataType: 'json',
            type: 'POST',
            data: comment,
            success: function (data) {
                $.ajax({
                    url: this.props.url,
//                        dataType: 'json',
                    type: 'GET',
                    success: function (data) {
                        this.setState({data: data});
                    }.bind(this),
                    error: function (xhr, status, err) {
                        console.error(this.props.url, status, err.toString());
                    }.bind(this)
                });
            }.bind(this),
            error: function (xhr, status, err) {
                console.error(this.props.url, status, err.toString());
            }.bind(this)
        });
    },
    getInitialState: function () {
        return {data: []};
    },
    componentDidMount: function () {
        this.loadCommentsFromServer();
        setInterval(this.loadCommentsFromServer, this.props.pollInterval);
    },
    render: function () {
        return (
            <div className="commentBox">
                <h1>Comments</h1>
                <CommentList data={this.state.data} />
                <CommentForm onCommentSubmit={this.handleCommentSubmit} />
            </div>
        );
    }
});

var initNotesApp = function () {
    React.render(
        <CommentBox url="api/note" pollInterval={2000} />,
        document.getElementById('content')
    );
};

initNotesApp();