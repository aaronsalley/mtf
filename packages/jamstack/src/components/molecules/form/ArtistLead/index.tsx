import { useState } from 'react';

const ArtistLeadForm = () => {
  const [formData, setFormData] = useState();

  return (
    <form>
      <input name="fname"></input>
      <input name="lname"></input>
      <input name="email"></input>
      <input name=""></input>
      <input name=""></input>
      <input name=""></input>
      <input name=""></input>
      <input name=""></input>
      <input name=""></input>
      <input name=""></input>
    </form>
  );
};

export default ArtistLeadForm;
