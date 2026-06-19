# Modèle Physique des Données (MPD)

Extrait du Tableau 4 (Formalisme du modèle physique des données), chapitre IV du document.

## Table `compte`
| Champ | Type | Clé | Null | Particularité |
|---|---|---|---|---|
| id_c | int | PK | Non | AUTO_INCREMENT |
| nom_c | varchar(255) | | Non | |
| sexe_c | varchar(10) | | Non | |
| denom_zone | varchar(25) | FK | Non | |
| denom_aire | varchar(25) | FK | Non | |
| denom_struct | varchar(25) | FK | Non | |
| fonction_c | varchar(25) | | Non | |
| mail_c | varchar(255) | | Non | |
| pswd_c | varchar(255) | | Non | |

## Table `unite`
| Champ | Type | Clé | Null | Particularité |
|---|---|---|---|---|
| id_u | int | PK | Non | AUTO_INCREMENT |
| denom_zone | varchar(25) | FK | Non | |
| denom_aire | varchar(25) | FK | Non | |
| denom_struct | varchar(25) | FK | Non | |
| sensibilisation | int | | Non | défaut 0 |
| cumul_sens | int | | Non | défaut 0 |
| distribution | int | | Non | défaut 0 |
| cumul_distr | int | | Non | défaut 0 |
| ist_consult | int | | Non | défaut 0 |
| cumul_ist_consult | int | | Non | défaut 0 |
| ist_diag | int | | Non | défaut 0 |
| cumul_ist_diag | int | | Non | défaut 0 |
| ist_contact | int | | Non | défaut 0 |
| cumul_ist_contact | int | | Non | défaut 0 |
| date_ajout | datetime | | Non | défaut CURRENT_TIMESTAMP |

## Table `t_structure`
| Champ | Type | Clé | Null | Particularité |
|---|---|---|---|---|
| denom_struct | varchar(25) | PK | Non | |
| zone_sante | varchar(25) | | Non | |
| aire_sante | varchar(25) | | Non | |

## Table `t_aire`
| Champ | Type | Clé | Null | Particularité |
|---|---|---|---|---|
| denom_aire | varchar(25) | PK | Non | |
| nom_zone | varchar(25) | | Non | |

## Table `t_zone`
| Champ | Type | Clé | Null | Particularité |
|---|---|---|---|---|
| denom_zone | varchar(25) | PK | Non | |
| localisation | text | | Non | |
| telephone | varchar(15) | | Non | |

## Table `fiche`
| Champ | Type | Clé | Null | Particularité |
|---|---|---|---|---|
| id_f | int | PK | Non | AUTO_INCREMENT |
| denom_zone | varchar(25) | FK | Non | |
| denom_aire | varchar(25) | FK | Non | |
| denom_struct | varchar(25) | FK | Non | |
| nom_p | varchar(255) | | Non | |
| post_p | varchar(255) | | Non | |
| prenom_p | varchar(255) | | Non | |
| telephone_p | varchar(20) | | Non | |
| naissance_p | date | | Non | |
| sexe_p | varchar(10) | | Non | |
| categorie_p | varchar(10) | | Non | |
| adresse_p | text | | Non | |
| r_d_struct_p | varchar(20) | | Non | |
| test_p | varchar(10) | | Non | |
| retrait_p | varchar(10) | | Non | |
| positif_p | varchar(10) | | Non | |
| contact_p | varchar(10) | | Non | |
| femme_f | varchar(10) | | Non | |
| sousarv_p | varchar(10) | | Non | |
| etat_p | varchar(20) | | Non | |
| rithme_p | varchar(20) | | Non | |

## Table `femme`
| Champ | Type | Clé | Null | Particularité |
|---|---|---|---|---|
| id_fem | int | PK | Non | AUTO_INCREMENT |
| id_f | int | FK | Non | |
| moment_depist | varchar(10) | | Non | |
| enfant_suivi | varchar(10) | | Non | |

## Table `cascontact`
| Champ | Type | Clé | Null | Particularité |
|---|---|---|---|---|
| id_cas | int | PK | Non | AUTO_INCREMENT |
| id_f | int | FK | Non | |
| nom_cas | varchar(255) | | Non | |
| age_cas | int | | Non | |
| sexe_cas | varchar(10) | | Non | |
| positif_cas | varchar(10) | | Non | |
| retrait_cas | varchar(10) | | Non | |
| sousarv_cas | varchar(10) | | Non | |
