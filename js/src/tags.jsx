var TagItem = React.createClass({
    getInitialState: function () {
        return {
            notesCount: 0
        };
    },
    loadFromServer: function () {
        $.ajax({
            url: this.props.url + '/notes',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                this.setState({notesCount: data.length});
            }.bind(this),
            error: function (xhr, status, err) {
                console.error(this.props.url, status, err.toString());
            }.bind(this)
        });
    },
    componentDidMount: function () {
        this.loadFromServer();
    },
    render: function () {
        return (
            <li className={"list-group-item " + this.props.style} onClick={this.props.onClick}>
                <span className="badge">{this.state.notesCount}</span>
                {this.props.title}
            </li>
        );
    }
});

var TagList = React.createClass({

    loadFromServer: function () {
        $.ajax({
            url: this.props.url,
            dataType: 'json',
            success: function (data) {
                this.setState({tags: data});
            }.bind(this),
            error: function (xhr, status, err) {
                console.error(this.props.url, status, err.toString());
            }.bind(this)
        });
    },
    getInitialState: function () {
        return {
            focused: 0,
            tags: []
        };
    },
    componentDidMount: function () {
        this.loadFromServer();
        setInterval(this.loadFromServer, this.props.pollInterval);
    },
    clicked: function (index, tag_id) {
        $.ajax({
            url: this.props.url + '/' + tag_id + '/notes',
            dataType: 'json',
            success: function (data) {
                console.log('clicked', tag_id, data);
                NotesList.setState({notes: data});
            }.bind(this),
            error: function (xhr, status, err) {
                console.error(this.props.url + '/notes', status, err.toString());
            }.bind(this)
        });
        this.setState({focused: index});
    },
    render: function () {
        var self = this;
        var tagNodes = this.state.tags.map(function (tag, index) {
            var style = '';
            if(self.state.focused == index){
                style = 'active';
            }
            return (
                <TagItem id={tag.id} title={tag.title} style={style} onClick={self.clicked.bind(self, index, tag.id)}
                    url={self.props.url + '/' + tag.id}>
                </TagItem>
            );
        });
        return (
            <div className="tagList">
                <ul className="list-group">
                   {tagNodes}
                </ul>
            </div>
        );
    }
});