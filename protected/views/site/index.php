<?php
    /* @var $this SiteController */

    $this->pageTitle=Yii::app()->name;
    Yii::app()->clientScript->registerPackage('notes_reactjs');
//    $this->onload = 'renderNotes';
?>

<h1>This is index</h1>

<div id="content"></div>
<script>
    initNotesApp();
</script>
<!--<script type="text/jsx">-->
<!---->
<!--    var converter = new Showdown.converter();-->
<!---->
<!--    var Comment = React.createClass({-->
<!--        render: function () {-->
<!--            var rawMarkup = converter.makeHtml(this.props.children.toString());-->
<!--            return (-->
<!--                <div className="comment">-->
<!--                    <h2 className="commentAuthor">-->
<!--                    {this.props.id}-->
<!--                    </h2>-->
<!--                    <span dangerouslySetInnerHTML={{__html: rawMarkup}} />-->
<!--                </div>-->
<!--            );-->
<!--        }-->
<!--    });-->
<!---->
<!--    var CommentList = React.createClass({-->
<!--        render: function () {-->
<!--            var commentNodes = this.props.data.map(function (comment) {-->
<!--                return (-->
<!--                    <Comment id={comment.id}>-->
<!--                    {comment.title}-->
<!--                    </Comment>-->
<!--                );-->
<!--            });-->
<!--            return (-->
<!--                <div className="commentList">-->
<!--                {commentNodes}-->
<!--                </div>-->
<!--            );-->
<!--        }-->
<!--    });-->
<!---->
<!--    var CommentForm = React.createClass({-->
<!--        handleSubmit: function (e) {-->
<!--            e.preventDefault();-->
<!--            var title = this.refs.title.getDOMNode().value.trim();-->
<!--            if (!title) {-->
<!--                return;-->
<!--            }-->
<!--            console.log(title);-->
<!--            // TODO: send request to the server-->
<!--            this.props.onCommentSubmit({title: title});-->
<!--            this.refs.title.getDOMNode().value = '';-->
<!--        },-->
<!--        render: function () {-->
<!--            return (-->
<!--                <form className="commentForm" onSubmit={this.handleSubmit}>-->
<!--                    <input type="text" placeholder="Write something..." ref="title" />-->
<!--                    <input type="submit" value="Note it" />-->
<!--                </form>-->
<!--            );-->
<!--        }-->
<!--    });-->
<!---->
<!---->
<!--    var CommentBox = React.createClass({-->
<!--        loadCommentsFromServer: function () {-->
<!--            $.ajax({-->
<!--                url: this.props.url,-->
<!--                dataType: 'json',-->
<!--                success: function (data) {-->
<!--                    this.setState({data: data});-->
<!--                }.bind(this),-->
<!--                error: function (xhr, status, err) {-->
<!--                    console.error(this.props.url, status, err.toString());-->
<!--                }.bind(this)-->
<!--            });-->
<!--        },-->
<!--        handleCommentSubmit: function (comment) {-->
<!--            var comments = this.state.data;-->
<!--            var newComments = comments.concat([comment]);-->
<!--            this.setState({data: newComments});-->
<!--            $.ajax({-->
<!--                url: this.props.url,-->
<!--                dataType: 'json',-->
<!--                type: 'POST',-->
<!--                data: comment,-->
<!--                success: function (data) {-->
<!--                    $.ajax({-->
<!--                        url: this.props.url,-->
<!--//                        dataType: 'json',-->
<!--                        type: 'GET',-->
<!--                        success: function (data) {-->
<!--                            this.setState({data: data});-->
<!--                        }.bind(this),-->
<!--                        error: function (xhr, status, err) {-->
<!--                            console.error(this.props.url, status, err.toString());-->
<!--                        }.bind(this)-->
<!--                    });-->
<!--                }.bind(this),-->
<!--                error: function (xhr, status, err) {-->
<!--                    console.error(this.props.url, status, err.toString());-->
<!--                }.bind(this)-->
<!--            });-->
<!--        },-->
<!--        getInitialState: function () {-->
<!--            return {data: []};-->
<!--        },-->
<!--        componentDidMount: function () {-->
<!--            this.loadCommentsFromServer();-->
<!--            setInterval(this.loadCommentsFromServer, this.props.pollInterval);-->
<!--        },-->
<!--        render: function () {-->
<!--            return (-->
<!--                <div className="commentBox">-->
<!--                    <h1>Comments</h1>-->
<!--                    <CommentList data={this.state.data} />-->
<!--                    <CommentForm onCommentSubmit={this.handleCommentSubmit} />-->
<!--                </div>-->
<!--            );-->
<!--        }-->
<!--    });-->
<!--    React.render(-->
<!--        <CommentBox url="api/note" pollInterval={200000} />,-->
<!--        document.getElementById('content')-->
<!--    );-->
<!---->
<!--</script>-->
