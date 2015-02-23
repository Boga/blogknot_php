var NoteItem = React.createClass({
    render: function () {
        return (
            <li className={"list-group-item " + this.props.style} onClick={this.props.onClick}>
                <img className="media-object" src="http://placehold.it/64x64" alt="Media for note"/>
                    <h4>{this.props.title}</h4>
                    {this.props.date}
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
                this.setState({notes: data});
            }.bind(this),
            error: function (xhr, status, err) {
                console.error(this.props.url, status, err.toString());
            }.bind(this)
        });
    },
    getInitialState: function () {
        return {
            focused: 0,
            notes: []
        };

    },
    clicked: function (index) {
        this.setState({focused: index});
    },
    componentDidMount: function () {
        this.loadFromServer();
        setInterval(this.loadFromServer, this.props.pollInterval);
    },

    render: function () {
        var self = this;
        var noteNodes = this.state.notes.map(function (note, index) {
            var style = '';
            if(self.state.focused == index){
                style = 'active';
            }
            return (
                <NoteItem id={note.id} title={note.title} date={note.date} style={style}
                    onClick={self.clicked.bind(self, index)}>
                </NoteItem>
            );
        });
        return (
            <div className="noteList">
                <ul className="list-group">
                    {noteNodes}
                </ul>
            </div>
        );
    }
});