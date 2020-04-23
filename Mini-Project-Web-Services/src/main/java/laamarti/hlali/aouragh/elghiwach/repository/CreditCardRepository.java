package laamarti.hlali.aouragh.elghiwach.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import laamarti.hlali.aouragh.elghiwach.model.CreditCard;

@Repository
public interface CreditCardRepository extends JpaRepository<CreditCard,Long> {
	
	
}
