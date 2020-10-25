import React, { Component } from 'react'
import Data from './movies.json'


export default class Movies extends Component {


    constructor(){
        super();
    
        this.state={
          search: '',
          cat: ''
        };
      }
    
      searchSpace = (event) => {
        let keyword = event.target.value;
        this.setState({search:keyword})
      }

      catSearch = (event) => {
        let keyword = event.target.value;
        this.setState({cat:keyword})
      }

    render() {
        return (
            <div>
                <input type="text" placeholder="Enter name to be searched" onChange={(e)=>this.searchSpace(e)} />
                <input type="text" placeholder="Enter category to be searched" onChange={(e)=>this.catSearch(e)} />

               {Data.map((item) => {

                   if (item.name.toLowerCase().includes(this.state.search.toLowerCase()) || item.descr.toLowerCase().includes(this.state.search.toLowerCase())) {
                    return <div>
                    <img src= {item.thumbnail} />
                    <h3>{item.name}</h3>
                    <p> {item.descr} </p>
                    <strong>Category : {item.category} </strong>
                    </div> 
                   }
               })}
            </div>
        )
    }
}
