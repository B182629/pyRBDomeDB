CREATE database if not exists pyrbdome_new ;
use pyrbdome_new ;


CREATE TABLE IF NOT EXISTS `interpro_results` (
`Protein_accession` VARCHAR(20) NOT NULL,
`Sequence_MD5_digest` VARCHAR(50),
`Sequence_length` VARCHAR(5),
`Analysis` VARCHAR(10),
`Signature_accession` VARCHAR(100),
`Signature_description` TEXT,
`Start_location` VARCHAR(5),
`Stop_location` VARCHAR(5),
`e_value` VARCHAR(10),
`Status` TEXT,
`Date` TEXT,
`InterPro_annotations_accession` VARCHAR(20),
`InterPro_annotations_description` TEXT
);

CREATE TABLE IF NOT EXISTS `InterProScan_Pfam_data` (
`Start` VARCHAR(5) NOT NULL,
`Stop` VARCHAR(5) NOT NULL,
`Protein_accession` VARCHAR(20) NOT NULL,
`Signature_accession` VARCHAR(20),
`CL` VARCHAR(20),
`Domain` VARCHAR(100),
`Id` VARCHAR(50),
`Description` VARCHAR(1000),
`Domain_sequence` VARCHAR (1000)
);

CREATE TABLE IF NOT EXISTS `available_pdbs` (
`ID` VARCHAR(15) NOT NULL,
`pdb_id` VARCHAR(20),
`pdb_downloaded` VARCHAR(3),
`chains` CHAR(1),
`RNABindRPlus` VARCHAR(32),
`PST_PRNA` VARCHAR(32),
`BindUP` VARCHAR(32),
`aaRNA` VARCHAR(32),
`DisoRDPbind` VARCHAR(32),
`FTMap` VARCHAR(32)
);

CREATE TABLE IF NOT EXISTS `pyrbdome_analysis` (
`ID` VARCHAR(15) NOT NULL,
`Protein` VARCHAR(20) NOT NULL,
`RBS_aa` CHAR(1) NOT NULL,
`RBS_aa_location` VARCHAR(4) NOT NULL,
`Peptide` VARCHAR(50),
`pdb_id` VARCHAR(20),
`pdb_downloaded` VARCHAR(3) NOT NULL,
`chains` CHAR(1)
);

CREATE TABLE IF NOT EXISTS `processed_files_log` (
`ID` VARCHAR(15) NOT NULL,
`pdb_id` VARCHAR(20) NOT NULL,
`pdb_downloaded` VARCHAR(3) NOT NULL,
`chains` CHAR(1),
`PeptideFiles` VARCHAR(32),
`AminoAcidFiles` VARCHAR(32),
`aaRNA` VARCHAR(32),
`PST_PRNA` VARCHAR(32),
`FTMap` VARCHAR(32),
`RNABindRPlus` VARCHAR(32),
`DisoRDPbind` VARCHAR(32),
`HydRa` VARCHAR(32),
`DomainFiles` VARCHAR(32)
);

CREATE TABLE IF NOT EXISTS `trypsin_in_silico_peptides` (
`ID` VARCHAR(15) NOT NULL,
`pdb_id` VARCHAR(20) NOT NULL,
`chains` CHAR(1),
`Peptide` VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS `Lys_C_in_silico_peptides` (
`ID` VARCHAR(15) NOT NULL,
`pdb_id` VARCHAR(20) NOT NULL,
`chains` CHAR(1),
`Peptide` VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS `random_peptides` (
`ID` VARCHAR(15) NOT NULL,
`Protein` VARCHAR(20),
`Peptide` VARCHAR(50),
`pdb_id` VARCHAR(20) NOT NULL,
`pdb_downloaded` VARCHAR(3) NOT NULL,
`chains` CHAR(1)
);

CREATE TABLE IF NOT EXISTS `RNA_binding_peptides_with_match_in_pdb` (
`ID` VARCHAR(15) NOT NULL,
`pdb_id` VARCHAR(20) NOT NULL,
`chains` CHAR(1),
`Peptide` VARCHAR(50),
`Found_peptide` VARCHAR(50),
`FTMap_results` VARCHAR(50),
`FTMap_distances` VARCHAR(50),
`PST_PRNA_results` VARCHAR(50),
`PST_PRNA_distances` VARCHAR(50),
`RNABindRPlus_results` VARCHAR(50),
`RNABindRPlus_distances` VARCHAR(50),
`DisoRDPbind_results` VARCHAR(50),
`DisoRDPbind_distances` VARCHAR(50),
`BindUP_results` VARCHAR(50),
`BindUP_distances` VARCHAR(50),
`aaRNA_results` VARCHAR(50),
`aaRNA_distances` VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS `trypsin_peptides_with_match_in_pdb` (
`ID` VARCHAR(15) NOT NULL,
`pdb_id` VARCHAR(20) NOT NULL,
`chains` CHAR(1),
`Peptide` VARCHAR(50),
`Found_peptide` VARCHAR(50),
`FTMap_results` VARCHAR(50),
`FTMap_distances` VARCHAR(50),
`PST_PRNA_results` VARCHAR(50),
`PST_PRNA_distances` VARCHAR(50),
`RNABindRPlus_results` VARCHAR(50),
`RNABindRPlus_distances` VARCHAR(50),
`DisoRDPbind_results` VARCHAR(50),
`DisoRDPbind_distances` VARCHAR(50),
`BindUP_results` VARCHAR(50),
`BindUP_distances` VARCHAR(50),
`aaRNA_results` VARCHAR(50),
`aaRNA_distances` VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS `lys_C_peptides_with_match_in_pdb` (
`ID` VARCHAR(15) NOT NULL,
`pdb_id` VARCHAR(20) NOT NULL,
`chains` CHAR(1),
`Peptide` VARCHAR(50),
`Found_peptide` VARCHAR(50),
`FTMap_results` VARCHAR(50),
`FTMap_distances` VARCHAR(50),
`PST_PRNA_results` VARCHAR(50),
`PST_PRNA_distances` VARCHAR(50),
`RNABindRPlus_results` VARCHAR(50),
`RNABindRPlus_distances` VARCHAR(50),
`DisoRDPbind_results` VARCHAR(50),
`DisoRDPbind_distances` VARCHAR(50),
`BindUP_results` VARCHAR(50),
`BindUP_distances` VARCHAR(50),
`aaRNA_results` VARCHAR(50),
`aaRNA_distances` VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS `random_peptides_with_match_in_pdb` (
`ID` VARCHAR(15) NOT NULL,
`pdb_id` VARCHAR(20) NOT NULL,
`chains` CHAR(1),
`Peptide` VARCHAR(50),
`Found_peptide` VARCHAR(50),
`RNABindRPlus_results` VARCHAR(50),
`RNABindRPlus_distances` VARCHAR(50),
`FTMap_results` VARCHAR(50),
`FTMap_distances` VARCHAR(50),
`PST_PRNA_results` VARCHAR(50),
`PST_PRNA_distances` VARCHAR(50),
`DisoRDPbind_results` VARCHAR(50),
`DisoRDPbind_distances` VARCHAR(50),
`BindUP_results` VARCHAR(50),
`BindUP_distances` VARCHAR(50),
`aaRNA_results` VARCHAR(50),
`aaRNA_distances` VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS `RNA_binding_amino_acids_with_match_in_pdb` (
`ID` VARCHAR(15) NOT NULL,
`pdb_id` VARCHAR(20) NOT NULL,
`chains` CHAR(1),
`Peptide` VARCHAR(50),
`Found_peptide` VARCHAR(50),
`Peptide_original` VARCHAR(50),
`aaRNA_results` VARCHAR(50),
`aaRNA_distances` VARCHAR(50),
`BindUP_results` VARCHAR(50),
`BindUP_distances` VARCHAR(50),
`FTMap_results` VARCHAR(50),
`FTMap_distances` VARCHAR(50),
`RNABindRPlus_results` VARCHAR(50),
`RNABindRPlus_distances` VARCHAR(50),
`PST_PRNA_results` VARCHAR(50),
`PST_PRNA_distances` VARCHAR(50),
`DisoRDPbind_results` VARCHAR(50),
`DisoRDPbind_distances` VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS `trypsin_amino_acids_with_match_in_pdb` (
`ID` VARCHAR(15) NOT NULL,
`pdb_id` VARCHAR(20) NOT NULL,
`chains` CHAR(1),
`Peptide` VARCHAR(50),
`Found_peptide` VARCHAR(50),
`Peptide_original` VARCHAR(50),
`aaRNA_results` VARCHAR(50),
`aaRNA_distances` VARCHAR(50),
`BindUP_results` VARCHAR(50),
`BindUP_distances` VARCHAR(50),
`FTMap_results` VARCHAR(50),
`FTMap_distances` VARCHAR(50),
`RNABindRPlus_results` VARCHAR(50),
`RNABindRPlus_distances` VARCHAR(50),
`PST_PRNA_results` VARCHAR(50),
`PST_PRNA_distances` VARCHAR(50),
`DisoRDPbind_results` VARCHAR(50),
`DisoRDPbind_distances` VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS `lys_C_amino_acids_with_match_in_pdb` (
`ID` VARCHAR(15) NOT NULL,
`pdb_id` VARCHAR(20) NOT NULL,
`chains` CHAR(1),
`Peptide` VARCHAR(50),
`Found_peptide` VARCHAR(50),
`Peptide_original` VARCHAR(50),
`aaRNA_results` VARCHAR(50),
`aaRNA_distances` VARCHAR(50),
`BindUP_results` VARCHAR(50),
`BindUP_distances` VARCHAR(50),
`FTMap_results` VARCHAR(50),
`FTMap_distances` VARCHAR(50),
`RNABindRPlus_results` VARCHAR(50),
`RNABindRPlus_distances` VARCHAR(50),
`PST_PRNA_results` VARCHAR(50),
`PST_PRNA_distances` VARCHAR(50),
`DisoRDPbind_results` VARCHAR(50),
`DisoRDPbind_distances` VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS `random_amino_acids_with_match_in_pdb` (
`ID` VARCHAR(15) NOT NULL,
`pdb_id` VARCHAR(20) NOT NULL,
`chains` CHAR(1),
`Peptide` VARCHAR(50),
`Found_peptide` VARCHAR(50),
`Peptide_original` VARCHAR(50),
`aaRNA_results` VARCHAR(50),
`aaRNA_distances` VARCHAR(50),
`BindUP_results` VARCHAR(50),
`BindUP_distances` VARCHAR(50),
`FTMap_results` VARCHAR(50),
`FTMap_distances` VARCHAR(50),
`RNABindRPlus_results` VARCHAR(50),
`RNABindRPlus_distances` VARCHAR(50),
`PST_PRNA_results` VARCHAR(50),
`PST_PRNA_distances` VARCHAR(50),
`DisoRDPbind_results` VARCHAR(50),
`DisoRDPbind_distances` VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS `All_combined_results` (
`ID` VARCHAR(15) NOT NULL,
`pdb_id` VARCHAR(20) NOT NULL,
`residue_number` VARCHAR(4) NOT NULL,
`amino_acid` CHAR(1) NOT NULL,
`aaRNA` VARCHAR(50),
`PST_PRNA` VARCHAR(50),
`BindUP` VARCHAR(50),
`FTMap_distances` VARCHAR(50),
`RNABindRPlus` VARCHAR(50),
`DisoRDPbind` VARCHAR(50),
`HydRa` VARCHAR(50),
`Distance_to_RNA` VARCHAR(100),
`PLIP` VARCHAR(100),
`Distance_to_PLIP` VARCHAR(100),
`predictions` TEXT,
`Domains` VARCHAR(100),
`Peptide` VARCHAR(100),
`Cross_linked_amino_acid` VARCHAR(10)
);

CREATE TABLE IF NOT EXISTS `MMAlign_RMSD_values` (
`ID` VARCHAR(15),
`pdb_id` VARCHAR(50),
`chains` VARCHAR(50),
`domain_accession` VARCHAR(50),
`RMSD` VARCHAR(50),
`extract_from` VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS `rna_bindingsite_analyses_log` (
`ID` VARCHAR(15) NOT NULL,
`chains` CHAR(1),
`pdb_id` VARCHAR(20), 
`aaRNA` VARCHAR(32), 
`PST_PRNA` VARCHAR(32), 
`BindUP` VARCHAR(32), 
`FTMap` VARCHAR(32),
`RNABindRPlus` VARCHAR(32), 
`DisoRDPbind` VARCHAR(32), 
`HydRa` VARCHAR(32)
);


