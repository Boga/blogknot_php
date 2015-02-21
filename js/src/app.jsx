var NotesBox = React.createClass({
    render: function () {
        return (
            <div className="notesBox">
                <TagList url={this.props.tags}  pollInterval={2000} />
                <NotesList url={this.props.notes}  pollInterval={2000} />
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