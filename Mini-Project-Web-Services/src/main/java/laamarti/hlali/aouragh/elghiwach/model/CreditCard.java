package laamarti.hlali.aouragh.elghiwach.model;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity
@Table( name = "CreditCard")
public class CreditCard {
	
	@Id
	@GeneratedValue(strategy = GenerationType.AUTO)
	private long id;
	
	@Column(name = "number")
	private String number; 
	
	@Column(name = "expiry_date")
	private String expiryDate;
	
	@Column(name = "control_number")
	private Integer controlNumber;
	
	@Column(name = "type")
	private String type;
	
	
	public CreditCard() {
		super();
	}


	public CreditCard(long id, String number, String expiryDate, Integer controlNumber, String type) {
		super();
		this.id = id;
		this.number = number;
		this.expiryDate = expiryDate;
		this.controlNumber = controlNumber;
		this.type = type;
	}


	public long getId() {
		return id;
	}


	public void setId(long id) {
		this.id = id;
	}


	public String getNumber() {
		return number;
	}


	public void setNumber(String number) {
		this.number = number;
	}


	public String getExpiryDate() {
		return expiryDate;
	}


	public void setExpiryDate(String expiryDate) {
		this.expiryDate = expiryDate;
	}


	public Integer getControlNumber() {
		return controlNumber;
	}


	public void setControlNumber(Integer controlNumber) {
		this.controlNumber = controlNumber;
	}


	public String getType() {
		return type;
	}


	public void setType(String type) {
		this.type = type;
	}


	@Override
	public String toString() {
		return "CreditCard [id=" + id + ", number=" + number + ", expiryDate=" + expiryDate + ", controlNumber="
				+ controlNumber + ", type=" + type + "]";
	}
	
	

}
