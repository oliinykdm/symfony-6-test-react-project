import React, {Component} from 'react';
import {Route, Routes, Link, Navigate, withRouter, BrowserRouter} from 'react-router-dom';
import NewShortMessage from './NewShortMessage';
import Moment from 'react-moment';
import 'moment-timezone';
import axios from 'axios';


class LatestShortMessages extends Component {
    constructor() {
        super();

        this.state = { short_messages: [], loading: true}
    }

    componentDidMount() {
        this.getShortMessages();
    }
    getShortMessages() {
        axios.get('/api/shortmessages').then(res => {
            const short_messages = res.data.slice(0,15);
            this.setState({ short_messages, loading: false })
        })
    }
    render() {
        const loading = this.state.loading;
        return (
            <div>
                <div>
                    <section className="row-section">
                        <div className="container">
                            <div className="row">
                                <h2 className="text-center"><span>List of the latest short messages</span></h2>
                            </div>
                {loading ? (
                    <div className={'row text-center'}>
                        <span className="fa fa-spin fa-spinner fa-4x"></span>
                    </div>
                ) : (
                    <div className={'row'}>
                        {this.state.short_messages.map(message =>
                            <div className="col-md-10 offset-md-1 row-block" key={message.id}>
                                <ul id="sortable">
                                    <li>
                                        <div className="media">
                                            <div className="media-body">
                                              <h4>{message.messageText}</h4>
                                                <p></p>
                                               <p><b>Author:</b>&nbsp;
                                                 {message.messageAuthor === 1
                                                    ? <i>Anonymous</i>
                                                    : <i>{message.messageAuthor}</i>
                                                }
                                               </p>
                                                <p><b>UUID:</b>&nbsp;
                                                    {message.uuid}</p>
                                                <p><b>Date:</b>&nbsp;
                                                    <Moment fromNow date={message.messageDate} />
                                                    </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        )}
                    </div>
                )}
                        </div>
                    </section>
                </div>
            </div>
        )
    }
}

export default LatestShortMessages;
