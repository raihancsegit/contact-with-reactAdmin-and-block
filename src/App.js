import React from "react";
const { useState, useEffect } = wp.element;

function App() {
  const [contacts, setContacts] = useState([]);
  const url = `${appLocalizer.apiUrl}/contact-signup/v1/contacts`;

  useEffect(() => {
    fetch(url)
      .then((response) => response.json())
      .then((data) => setContacts(data));
  }, []);

  const deleteContact = (id) => {
    const deleteUrl = `${appLocalizer.apiUrl}/contact-signup/v1/contact/${id}`;

    fetch(deleteUrl, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
        "X-WP-Nonce": appLocalizer.nonce,
      },
    })
      .then((response) => {
        if (response.ok) {
          // Remove the deleted contact from the state
          setContacts(contacts.filter((contact) => contact.id !== id));
        } else {
          console.error("Failed to delete contact");
        }
      })
      .catch((error) => console.error("Error:", error));
  };

  return (
    <>
      <h2>Contact Info</h2>
      <div className="table-container">
        <table className="styled-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Hobbies</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {contacts.map((contact) => (
              <tr key={contact.id}>
                <td>{contact.name}</td>
                <td>{contact.address}</td>
                <td>{contact.phone}</td>
                <td>{contact.email}</td>
                <td>{contact.hobbies}</td>
                <td>
                  <button onClick={() => deleteContact(contact.id)}>
                    Delete
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </>
  );
}

export default App;
