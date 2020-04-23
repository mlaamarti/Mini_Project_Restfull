package laamarti.hlali.aouragh.elghiwach.controller;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

import javax.validation.Valid;
import javax.xml.ws.Response;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import laamarti.hlali.aouragh.elghiwach.exception.ResourceNotFoundException;
import laamarti.hlali.aouragh.elghiwach.model.CreditCard;
import laamarti.hlali.aouragh.elghiwach.repository.CreditCardRepository;

@RestController
@RequestMapping("/api/v1")
public class CreditCardController {

	@Autowired
	private CreditCardRepository creditCardRepository;
	
	// create get all CreditCard api
	@GetMapping("/creditcard")
	public List<CreditCard> getAllCreditCard(){
		return creditCardRepository.findAll();
	}
	
	// create CreditCard
	@PostMapping("/creditcard")
	public String createCreditCard(@Valid @RequestBody CreditCard creditCard) {
		
		if(validateCreditCardNumber(creditCard.getNumber()))
			creditCardRepository.save(creditCard);
		else
			return " is an invalid credit card number";
		
		return "your credit card has been credited " + creditCard.toString();
	}
	
	
	// get CreditCard by id
	@GetMapping("/creditcard/{id}")
	public ResponseEntity<CreditCard> getCreditCardById(@PathVariable(value = "id") long id)
	
		throws ResourceNotFoundException {
		CreditCard creditCard = creditCardRepository.findById(id)
		.orElseThrow(() -> new ResourceNotFoundException("CreditCard not found for this id :: " + id));
		
		
        return ResponseEntity.ok().body(creditCard);
        
	}
	
	
	// update CreditCard
	 @PutMapping("/creditcard/{id}")
	 public ResponseEntity < CreditCard > updateCreditCard(@PathVariable(value = "id") Long id,
			
		@Valid @RequestBody CreditCard CreditCardDetails) throws ResourceNotFoundException {
		CreditCard creditCard = creditCardRepository.findById(id)
	            .orElseThrow(() -> new ResourceNotFoundException("CreditCard not found for this id :: " + id));

		creditCard.setNumber(creditCard.getNumber());
		creditCard.setExpiryDate(CreditCardDetails.getExpiryDate());
		creditCard.setControlNumber(CreditCardDetails.getControlNumber());
		creditCard.setType(CreditCardDetails.getType());
		
		final CreditCard updatedCreditCard = creditCardRepository.save(creditCard);
	   
		return ResponseEntity.ok(updatedCreditCard);
	}
	
	 
	// delete CreditCard by id
	@DeleteMapping("/creditcard/{id}")
	public Map < String, Boolean > deleteCreditCard(@PathVariable(value = "id") Long id)
	    throws ResourceNotFoundException {
		 CreditCard creditCard = creditCardRepository.findById(id)
	            .orElseThrow(() -> new ResourceNotFoundException("CreditCard not found for this id :: " + id));

		 creditCardRepository.delete(creditCard);
	     Map < String, Boolean > response = new HashMap < > ();
	        response.put("deleted", Boolean.TRUE);
	        
	        return response;
	}
	
	
	private boolean validateCreditCardNumber(String str) {

	    int[] ints = new int[str.length()];
	    for (int i = 0; i < str.length(); i++) {
	        ints[i] = Integer.parseInt(str.substring(i, i + 1));
	    }
	    for (int i = ints.length - 2; i >= 0; i = i - 2) {
	        int j = ints[i];
	        j = j * 2;
	        if (j > 9) {
	            j = j % 10 + 1;
	        }
	        ints[i] = j;
	    }
	    int sum = 0;
	    for (int i = 0; i < ints.length; i++) {
	        sum += ints[i];
	    }
	    if (sum % 10 == 0)
	    	return true;
	    	
	    return false;
	
	}
	
}
