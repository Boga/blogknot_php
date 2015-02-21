var NotesBox = React.createClass({
    render: function () {
        return (
            <div className="notesBox">
                <div className="col-md-2">
                    <TagList url={this.props.tags}  pollInterval={2000} />
                </div>
                <div className="col-md-3">
                    <NotesList url={this.props.notes}  pollInterval={2000} />
                </div>
                <div className="col-md-7">
                    Note body
                </div>
            </div>
        );
    }
});

var initNotesApp = function () {
    React.render(
        <NotesBox tags="api/tag" notes="api/note" pollInterval={2000} />,
        document.getElementById('content')
    );
};

initNotesApp();