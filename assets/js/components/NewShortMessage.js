import React, {Component} from 'react';
import axios from 'axios';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

class NewShortMessage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            value: ''
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }


    addShortMessage() {
        let data = new FormData();
        data.append('message_text', this.state.value);
        axios
            .post("/api/shortmessages", data)
            .then((response) => {

                if(response.data.status === 'success') {
                    toast.success('Good! Your short message was posted successfully!', {
                        position: "top-center",
                        autoClose: 5000,
                        hideProgressBar: false,
                        closeOnClick: true,
                        pauseOnHover: true,
                        draggable: true,
                        progress: undefined,
                    });
                    this.setState({value: ''});
                }
                else {
                    toast.error(response.data.data, {
                        position: "top-center",
                        autoClose: 5000,
                        hideProgressBar: false,
                        closeOnClick: true,
                        pauseOnHover: true,
                        draggable: true,
                        progress: undefined,
                    });

                }
            }, (error) => {
                console.log(error);
            });
    }
    handleChange(event) {
        this.setState({value: event.target.value});
    }

    handleSubmit(event) {
        this.addShortMessage();
        event.preventDefault();
    }

    render() {
        return (
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center"><span>Add a new short message</span></h2>
                        </div>

                        <div className="">

                                <div className="col-md-10 offset-md-1 row-block">
                                    <ul id="sortable">
                                        <li>
                                            <div className="media">
                                                <div className="media-body">
                                                    <center><h4></h4></center>

                                                    <div className="form-group">
                                                        <form name="add_new_short_message" onSubmit={this.handleSubmit}>

                                                        <label htmlFor="add_new_short_message">Your short message (up to 200 symbols) here:</label>
                                                        <textarea className="form-control" id="add_new_short_message" name="message_text" rows="4" value={this.state.value}  onChange={this.handleChange} />

                                                        <p></p>

                                                        <button type="submit" className="btn btn-success">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                        </div>


                    </div>
                </section>
            </div>
        )
    }
}

export default NewShortMessage;
