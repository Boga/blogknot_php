var Note = React.createClass({
    render: function () {
        return (
            <li role="presentation">
                <a href={this.props.id} class="btn btn-default" role="button">
                    {this.props.date}&nbsp;{this.props.title}
                </a>
            </li>
        );
    }
});

var NotesList = React.createClass({

    loadFromServer: function () {
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
    getInitialState: function () {
        return {data: []};
    },
    componentDidMount: function () {
        this.loadFromServer();
        setInterval(this.loadFromServer, this.props.pollInterval);
    },

    render: function () {
        var noteNodes = this.state.data.map(function (note) {
            return (
                <Note id={note.id} title={note.title}> date={note.date}>
                </Note>
            );
        });
        return (
            <div className="noteList col-md-3 panel panel-default">
                <ul className="nav nav-pills nav-stacked">
                    {noteNodes}
                </ul>
            </div>
        );
    }
});