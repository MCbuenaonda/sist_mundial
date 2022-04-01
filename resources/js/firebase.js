import firebase from 'firebase/app'
import 'firebase/database'

const firebaseConfig = {
    apiKey: "AIzaSyCgyKjTlL3yFyrqAuyTM5oZBrAEZzGQnjY",
    authDomain: "myapp-7ca51.firebaseapp.com",
    databaseURL: "https://myapp-7ca51.firebaseio.com",
    projectId: "myapp-7ca51",
    storageBucket: "myapp-7ca51.appspot.com",
    messagingSenderId: "747344295568",
    appId: "1:747344295568:web:3c6f68e803c92c98654a15"
}

firebase.initializeApp(firebaseConfig);
const db = firebase.database()
export { db }